<?php

declare(strict_types=1);

namespace App\Application\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use MyBuilder\Bundle\CronosBundle\Annotation\Cron;

/**
 * @Cron(minute="/2", noLogs=true)
 */
class UserCommand extends Command
{
     /**
     * @var UserManager
     */
    private $userManager;

    public function __construct(UserManager $userManager)
    {
        parent::__construct();
        $this->userManager = $userManager;
    }

    protected function configure()
    {
        $this
            ->setName('user:create')
            ->setDescription('Create a test user.');
            /*->addArgument('email', InputArgument::REQUIRED)
            ->addArgument('password', InputArgument::REQUIRED)
            ->addArgument('name', InputArgument::OPTIONAL);*/
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
    	/*/$email = $input->getArgument('email');
        $password = $input->getArgument('password');
        $name = $input->getArgument('name');

        $output->writeln(
            sprintf('Электронный адрес - %s, Пароль - %s, Имя - %s', $email, $password, $name ?? 'default')
        );*/
        /*$questionHelper = $this->getHelper('question');

        $email = $questionHelper->ask($input, $output, new Question('<info>Email: </info>'));
        $password = $questionHelper->ask($input, $output, new Question('<info>Password: </info>'));
        $name = $questionHelper->ask($input, $output, new Question('<info>Name: </info>'));

        $output->writeln(
            sprintf('<comment>Имя пользователя - %s, электронный адрес - %s, пароль - %s</comment>',
                $name, $email, $password
            )
        );*/
        $this->userManager->recordEvent(
            'User',
            "Yes"
        );
    }
}