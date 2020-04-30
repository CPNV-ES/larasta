<?php
/**
 * MiniRequiredLevel
 * 
 * This class provides custom validation to verify if a request field is editable by the custom user.
 * Ex : if you just have to restrict the acces of certains fields you can use this rule to validate if the level of the authenticated user is sufficiant.
 * If you vant to check the authorisation just for one value you pass in the field you cans also pass a second argument with the value.
 * 
 * Bastien Nicoud
 * v1.0.0
 */

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use CPNVEnvironment\Environment;
use Illuminate\Support\Facades\Auth;

class MinRequiredLevel implements Rule
{
    private $level;
    private $needle;

    /**
     * Create a new rule instance.
     *
     * @param int $level The min level required to edit the field
     * @param mixed $needle Optional check the authorisation only if the field checked contains the needle
     * 
     * @return void
     */
    public function __construct(int $level, $needle = null)
    {
        $this->level = $level;
        $this->needle = $needle;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * 
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Check if a needle atribute is present
        if ($this->needle != null) {
            // If the needle correspond to the field value, we check the authorisation
            if ($this->needle == $value) {
                return Auth::user()->role >= $this->level;
            } else {
                return true;
            }

        // if we have no needle, just check the level
        } else {
            return Auth::user()->role >= $this->level;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Vous n'avez pas les acces pour editer ce champ.";
    }
}
