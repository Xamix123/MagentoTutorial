<?php

namespace Learning\CarTutorial\Block;

class ChildBlock extends ParentBlock
{
    public function showBlockName()
    {
        echo "==>i am in ChildBLock";
    }

}
