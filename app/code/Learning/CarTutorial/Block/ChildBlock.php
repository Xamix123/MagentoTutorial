<?php

namespace Learning\CarTutorial\Block;

class ChildBlock extends ParentBlock
{
    public function showBlockName()
    {
        echo "==>i am in ChildBLock";
    }

//    public function _toHtml()
//    {
//        return '<p><strong>i am strong Child Block</strong></p>';
//    }
}
