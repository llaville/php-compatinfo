<?php
/**
 * Credits to https://github.com/PHPCompatibility/PHPCompatibility project for sniff examples file
 *
 * @link https://github.com/PHPCompatibility/PHPCompatibility/blob/fe409a40096336df71aefdc437d2bdd68aedc59f/Tests/sniff-examples/forbidden_names_as_declared.php
 */

namespace null;
namespace true;
namespace false;
namespace bool;
namespace int;
namespace float;
namespace string;
namespace resource;
namespace object;
namespace mixed;
namespace numeric;
namespace iterable;
namespace never;

// Multi-level namespaces.
namespace MyProject\null\Level;
namespace MyProject\Sub\true;
namespace MyProject\false\Level;
namespace MyProject\Sub\bool;
namespace MyProject\int\Level;
namespace MyProject\Sub\float;
namespace MyProject\string\Level;
namespace MyProject\Sub\resource;
namespace MyProject\object\Level;
namespace MyProject\Sub\mixed;
namespace MyProject\numeric\Level;
namespace MyProject\Sub\Iterable;
namespace MyProject\Sub\Never;
