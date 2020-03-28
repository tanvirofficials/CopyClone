<?php

namespace Tanvirofficials\CopyClone;

use Laravel\Nova\ResourceTool;

class CopyClone extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Copy Clone';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'copy-clone';
    }
}
