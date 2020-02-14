<?php


namespace App\Controller\VoteControllers;



use App\Entity\Prize;
use App\Entity\Projet;
use App\Entity\Vote;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class GetVoteByPrize
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(Request $request)
    {
        $votesByPrize = array();
        $projectsVote = array();
        $prize_id = 47;
        $prize = $this->em->getRepository(Prize::class)->find($prize_id);
        $projects = $this->em->getRepository(Projet::class)->findByTypeId($prize->getType()->getId());
        foreach ($projects as $project){
            $projectsVote[0] = $project->getTitle();
            $projectsVote[1] = count($this->em->getRepository(Vote::class)->findVoteByProject($project->getId(),$prize_id));
            array_push($votesByPrize, $projectsVote);
        }

        return $votesByPrize;
    }
}