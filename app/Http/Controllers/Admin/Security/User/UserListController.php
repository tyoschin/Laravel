<?php


namespace App\Http\Controllers\Admin\Security\User;

use App\Base\Controller\AbstractListController;
use App\Base\Controller\HtmlFilter\Filter;
use App\Models\User;
use App\Services\Interfaces\IUserService;

class UserListController extends AbstractListController
{
    protected $userService;

    public function __construct(IUserService $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }

    public function prepareAction($method, $parameters): void {
        // формировать формировать список нужно тут
        $this->filter = (new Filter($this->request))
            ->add('text', 'name', ['choose_match' => true])
            ->title(__('admin.title'))
            ->default(['text' => '', 'exact' => true])
            ->filter()
            ->init();

        $this->data = $this->userService->paginateByFilter(
            $this->filter->getData(),
            [$this->sort => $this->by],
            $this->nav
        );
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', User::class);

        return view('admin.users.index', [
            'filterHtml' => $this->filter->render(),
            'users' => $this->data
        ]);
    }
}
