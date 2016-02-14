<?php

namespace rootLogin\DemoApp\Command;

use Saxulum\Console\Command\AbstractPimpleCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestUserCommand extends AbstractPimpleCommand
{
    protected function configure()
    {
        $this
            ->setName('demoapp:resetusers')
            ->setDescription('Create Test Users')
        ;
    }
    /**
     * @param  InputInterface    $input
     * @param  OutputInterface   $output
     * @return int|null|void
     * @throws \RuntimeException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $app = $this->container;

        $users = $user = $app['user.manager']->findBy();
        foreach($users as $user) {
            $app['user.manager']->delete($user);
        }

        /** @var \rootLogin\UserProvider\Entity\User $user */
        $user = $app['user.manager']->create("testuser@example.com", "TestUser");
        $user->setEnabled(true);
        $app['user.manager']->save($user);

        /** @var \rootLogin\UserProvider\Entity\User $admin */
        $admin = $app['user.manager']->create("adminuser@example.com", "AdminUser");
        $admin->setEnabled(true);
        $admin->addRole('ROLE_ADMIN');
        $app['user.manager']->save($admin);

        $output->writeln('<info>success</info>');
    }
}