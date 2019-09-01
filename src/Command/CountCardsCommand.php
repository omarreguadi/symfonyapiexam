<?php

namespace App\Command;

use App\Entity\Card;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class CountCardsCommand extends Command
{
    protected static $defaultName = 'app:count-cards';
    private $entityManager;
    private $encoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        $this->entityManager = $entityManager;
        $this->encoder = $encoder;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Count cards of a user')
            ->addArgument('email', InputArgument:: REQUIRED, 'email');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $io->note(sprintf('Count cards of a User for email: %s', $email));
        $user = $this->entityManager->getRepository(User::class)->findOneBy(array('email' => $email));
        if ($user) {
            $cards = $this->entityManager->getRepository(Card::class)->findBy(array('user' => $user));
            $io->success(sprintf('The user created ' . count($cards) . ' cards'));
        } else {
            $io->error(sprintf('The user does not exist !'));
        }
    }
}
