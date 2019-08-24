<?php
/**
 * Created by PhpStorm.
 * User: alen
 * Date: 22.8.2019.
 * Time: 19:44
 */

namespace App\Controller;

use App\BattleLogistics\BattleCoordinator;
use App\DTO\BattleParameterDTO;
use App\Form\BattleParameterType;
use App\Transformer\ArmyTransformer;
use App\Transformer\BattleTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BattleController
 *
 * @package App\Controller
 */
class BattleController extends AbstractController
{
    /** @var ArmyTransformer $armyTransformer */
    protected $armyTransformer;

    /** @var BattleTransformer $battleTransformer */
    protected $battleTransformer;

    /** @var BattleCoordinator $battleCoordinator */
    protected $battleCoordinator;

    /**
     * BattleController constructor.
     *
     * @param ArmyTransformer $armyTransformer
     * @param BattleTransformer $battleTransformer
     * @param BattleCoordinator $battleCoordinator
     */
    public function __construct(
        ArmyTransformer $armyTransformer,
        BattleTransformer $battleTransformer,
        BattleCoordinator $battleCoordinator
    ) {
        $this->armyTransformer = $armyTransformer;
        $this->battleTransformer = $battleTransformer;
        $this->battleCoordinator = $battleCoordinator;
    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->redirectToRoute('battle');
    }

    /**
     *  Entry point for battle
     *
     * @Route("/battle", name="battle", methods={"GET"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function battle(Request $request)
    {
        $form = $this->createForm(BattleParameterType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $battleParameterDTO = $form->getData();
            $armies = $this->armyTransformer->fromDTO($battleParameterDTO);
            $battle = $this->battleTransformer->fromDTO($battleParameterDTO);
            $battle_result = $this->battleCoordinator->battle($battle, $armies);

            return $this->render('battle.html.twig', [
                'form'      => $form->createView(),
                'winner'    => $battle_result['status']['attacker']->toArray(),
                'loser'     => $battle_result['status']['defender']->toArray(),
                'condition' => $battle_result['status']['condition'],
                'logs'      => $battle_result['logs']
            ]);
        }

        return $this->render('battle.html.twig', [
            'form'      => $form->createView()
        ]);
    }
}