<?php

namespace Api\V1\Http\Controllers;

use Api\V1\Http\Requests\CreateUserRequest;
use Api\V1\Http\Requests\UpdateUserRequest;
use App\Managers\User\Contracts\UserManager;
use App\Models\User;
use Illuminate\Routing\Controller;

/**
 * Class UsersController.
 *
 * @package Api\V1\Http\Controllers
 */
class UsersController extends Controller
{
    /**
     * @var UserManager
     */
    private $userManager;

    /**
     * UsersController constructor.
     *
     * @param UserManager $userManager
     */
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @apiVersion 1.0.0
     * @api {post} /v1/users Create
     * @apiName Create
     * @apiGroup Users
     * @apiHeader {String} Accept application/json
     * @apiHeader {String} Content-type application/json
     * @apiParam {String{1..255}} name User name.
     * @apiParam {String{1..255}} email User email address.
     * @apiParam {String{1..255}} password User password.
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 201 Created
     * {
     *     "id": 1,
     *     "name": "username",
     *     "email": "username@mail.address",
     *     "created_at": "2016-10-24 12:24:33",
     *     "updated_at": "2016-10-24 14:38:05",
     *     "role": "Customer"
     * }
     */

    /**
     * Create a user.
     *
     * @param CreateUserRequest $request
     * @return User
     */
    public function create(CreateUserRequest $request): User
    {
        $user = $this->userManager->createCustomer($request->all());

        return $user;
    }

    /**
     * @apiVersion 1.0.0
     * @api {get} /v1/users/:id Get
     * @apiName Get
     * @apiGroup Users
     * @apiHeader {String} Accept application/json
     * @apiParam {Integer{1...N}='me'} :id Unique resource ID.
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 20O OK
     * {
     *     "id": 1,
     *     "name": "username",
     *     "email": "username@mail.address",
     *     "created_at": "2016-10-24 12:24:33",
     *     "updated_at": "2016-10-24 14:38:05",
     *     "role": "Customer"
     * }
     */

    /**
     * Get a user.
     *
     * @param User $user
     * @return User
     */
    public function get(User $user): User
    {
        return $user;
    }

    /**
     * @apiVersion 1.0.0
     * @api {put} /v1/users/:id Update
     * @apiName Update
     * @apiGroup Users
     * @apiHeader {String} Accept application/json
     * @apiHeader {String} Content-type application/json
     * @apiParam {Integer{1...N}='me'} :id Unique resource ID.
     * @apiParam {String{1..255}} name User name.
     * @apiParam {String{1..255}} email User email address.
     * @apiParam {String{1..255}} password User password.
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 20O OK
     * {
     *     "id": 1,
     *     "name": "username",
     *     "email": "username@mail.address",
     *     "created_at": "2016-10-24 12:24:33",
     *     "updated_at": "2016-10-24 14:38:05",
     *     "role": "Customer"
     * }
     */

    /**
     * Update a user.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return User
     */
    public function update(UpdateUserRequest $request, User $user): User
    {
        $this->userManager->save($user, $request->all());

        return $user;
    }

    /**
     * @apiVersion 1.0.0
     * @api {delete} /v1/users/:id Delete
     * @apiName Delete
     * @apiGroup Users
     * @apiHeader {String} Accept application/json
     * @apiParam {Integer{1...N}='me'} :id Unique resource ID.
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 204 No Content
     */

    /**
     * Delete a user.
     *
     * @param User $user
     * @return void
     */
    public function delete(User $user): void
    {
        $this->userManager->delete($user);
    }
}
