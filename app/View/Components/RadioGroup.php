<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadioGroup extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public array $options,
    ) {
        //
    }

    // we create the function below in order to make the blade 
    // supports both associative and indexed arrays
    public function optionsWithLabels(): array
    {
        // array_is_list check if the array in indexed array (not associatvie)
        return array_is_list($this->options) ?
            array_combine($this->options, $this->options)
            : $this->options;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.radio-group');
    }
}
