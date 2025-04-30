<!-- markdownlint-disable MD013 -->
# Visitors

![GraPHP UML](../../assets/images/application-parser.graphviz.svg)

## ParentContextVisitor

The AST does not store parent nodes by default. However, the `ParentContextVisitor` is used to achieve this
in the following context: when elements are either _class_, _interface_, _trait_,
_function_, _closure_, _method_, _arrow function_ and _property_.

The parent context visitor accepts an option array as the first argument, with the following default values:

- the `nodeAttributeParentKeyStore` option contains the name of a new node attribute (default to `bartlett.parent`)
that will store the parent node of only elements referenced above.

The AST does not include a namespace node (`PhpParser\Node\Stmt\Namespace_`) when source code is only in global namespace.
The second goal of `ParentContextVisitor` is to add this node at top of node list to traverse (during the `beforeTraverse` method).

That will allow the `CompatibilityAnalyser` to show PHP versions required of full code in global namespace context.

For example with such script:

```php
<?php declare(strict_types=1);

function returnArray() {
    return ['one', 'two', 'three'];
}
$arrayValue1 = returnArray()[0];
```

PHP versions detected are :

- **7.0.0** for full script, due to declare directive usage.
- **5.4.0** for short array usage in `returnArray` function.
- **5.4.0** for usage of array dereferencing syntax when calling `returnArray` function.

## NameResolverVisitor

The `NameResolverVisitor` is applied to resolve names of each major elements
where the PHP versions should be detected. It extends the basic [Name Resolver](https://github.com/nikic/PHP-Parser/blob/master/doc/component/Name_resolution.markdown#the-nameresolver-visitor)
by default that did not add `namespacedName` property on all elements.

The name resolver accepts an option array as the second argument, with the following default values:

- the `nodeAttributeParentKeyStore` option contains the name of a new node attribute (default to `bartlett.parent`)
that reference the parent node of the following elements : _class_, _interface_, _trait_,
_function_, _closure_, _method_, _arrow function_ and _property_.

After running this visitor, the parent node can be obtained through `$node->getAttribute('bartlett.parent')`.
This will be useful with the `CompatibilityAnalyser` that should give PHP versions of each element including in their parent context.

## VersionResolverVisitor

The `VersionResolverVisitor` is in charge to initialize PHP versions on each element (_namespace_, _class_, _interface_, _trait_,
_function_, _closure_, _method_ or _arrow function_ nodes) of source code context.

The version resolver accepts an option array as the second argument, with the following default values:

- the `nodeAttributeParentKeyStore` option contains the name of a new node attribute (default to `bartlett.parent`).
Its value must be the same as the option used in the `NameResolverVisitor`.

- the `nodeAttributeKeyStore` option contains the name of a new node attribute (default to `bartlett.data_collector`)
that store the PHP versions of major elements.

After running this visitor, the PHP versions can be obtained through `$node->getAttribute('bartlett.data_collector')`.
This will be useful with the `CompatibilityAnalyser`.

When user classes, interfaces or traits referenced extensions elements (with type hinting, parameters and return),
it will call a local SQLite database to get information. Current [database](https://github.com/llaville/php-compatinfo-db) project
supports all data for almost a hundred extensions on each PHP versions from 5.2.17 to latest 7.4

The version resolver accepts an instance of `Bartlett\CompatInfo\Collection\ReferenceCollectionInterface` as the first argument.

This collection referenced all information in the SQLite database.

## FilterVisitor

The `FilterVisitor` is applied to retrieve all AST nodes that have attributes identified by `nodeAttributeKeyStore` option.

- Data in final format are retrieved by the `FilterVisitor::getCollection()` method.
- Data are normalized with the normalizer of the Symfony Serializer component, and transformed from internal format to final format
by the `NodeNormalizer` of DataCollector.

This visitor is used by the `VersionDataCollector`.
