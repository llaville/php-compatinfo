<?php
    $worker = new DocBlox_Parallel_Worker(
        function($task) { $task->perform(); },
        array($task)
    );
