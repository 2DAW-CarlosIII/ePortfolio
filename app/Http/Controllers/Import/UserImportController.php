<?php

namespace App\Http\Controllers\Import;

use App\Models\User;
use App\Http\Requests\Import\UserImportRequest;

class UserImportController extends BaseImportController
{
    protected string $modelClass = User::class;
    protected string $resourceName = 'User';
}
