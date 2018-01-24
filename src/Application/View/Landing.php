<?php

namespace Application\View;

use Symfony\Component\HttpFoundation\Response;
use Palladium\Service\Search;
use Model\Service\SignUp;
use Model\Entity\Account;use Palladium\Entity\Identity;
use Twig\Environment as Engine;

class Landing
{
    private $engine;
    private $search;
    private $account;


    public function __construct(Engine $engine, Account $account, Search $search)
    {
        $this->engine = $engine;
        $this->account = $account;
        $this->search = $search;
    }


    public function getDefault(): Response
    {
        $template = $this->engine->load('index.html.twig');

        $list = $this->search->findIdentitiesByAccountId($this->account->getId(), Identity::TYPE_EMAIL);
        if (count($list)) {
            $identity = $this->search->findEmailIdentityById($list->current()->getId());
            $email = $identity->getEmailAddress();
        }

        return new Response($template->render(['email' => $email ?? 'unknown']));
    }
}
