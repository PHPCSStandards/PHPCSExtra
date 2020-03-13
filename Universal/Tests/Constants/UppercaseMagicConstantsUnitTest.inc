<?php

namespace A\B;

class Foo {
    public static function bar() {
        // OK.
        echo __LINE__;
        echo __FILE__;
        echo __DIR__;
        echo __FUNCTION__;
        echo __CLASS__;
        echo __TRAIT__;
        echo __METHOD__;
        echo __NAMESPACE__;

        // Not ok.
        echo __line__;
        echo __file__;
        echo __dir__;
        echo __function__;
        echo __class__;
        echo __trait__;
        echo __method__;
        echo __namespace__;

        echo __Line__;
        echo __FiLe__;
        echo __DiR__;
        echo __Function__;
        echo __ClasS__;
        echo __tRAIT__;
        echo __Method__;
        echo __NameSpace__;
    }
}
