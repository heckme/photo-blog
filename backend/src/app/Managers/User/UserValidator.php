<?php

namespace App\Managers\User;

use function App\Util\validator_filter_attributes;
use App\Models\Role;
use App\Models\User;
use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Validation\Rule;

/**
 * Class UserValidator.
 *
 * @package App\Managers\User
 */
class UserValidator
{
    /**
     * @var ValidatorFactory
     */
    private $validatorFactory;

    /**
     * SubscriptionValidator constructor.
     *
     * @param ValidatorFactory $validatorFactory
     */
    public function __construct(ValidatorFactory $validatorFactory)
    {
        $this->validatorFactory = $validatorFactory;
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function validateForCreate(array $attributes): array
    {
        $validRoleIdRule = Rule::exists((new Role)->getTable(), 'id');
        $uniqueUserEmailRule = Rule::unique((new User)->getTable(), 'email');

        $rules = [
            'role_id' => ['required', $validRoleIdRule],
            'email' => ['required', 'email', 'min:1', 'max:255', $uniqueUserEmailRule],
            'name' => ['required', 'min:1', 'max:255'],
            'password' => ['required', 'min:1', 'max:255'],
        ];

        $this->validatorFactory->validate($attributes, $rules);

        return validator_filter_attributes($attributes, $rules);
    }

    /**
     * @param User $user
     * @param array $attributes
     * @return array
     */
    public function validateForSave(User $user, array $attributes): array
    {
        $uniqueUserEmailRule = Rule::unique((new User)->getTable(), 'email')->ignore($user->id);

        $rules = [
            'email' => ['filled', 'min:1', 'max:255', $uniqueUserEmailRule],
            'name' => ['filled', 'min:1', 'max:255'],
            'password' => ['filled', 'min:1', 'max:255'],
        ];

        $this->validatorFactory->validate($attributes, $rules);

        return validator_filter_attributes($attributes, $rules);
    }
}
