<?php
namespace App\Controller;
use App\Entity\Category;
use App\Entity\Person;
use App\Entity\ShareGroup;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Expense;
/**
 * Class ExpenseController
 * @package App\Controller
 * @Route("/expense")
 */
class ExpenseController extends BaseController
{
    /**
     * @Route("/group/{slug}", name="expense", methods="GET")
     */
    public function index(ShareGroup $shareGroup)
    {
        $expense = $this->getDoctrine()->getRepository(Expense::class)
            ->createQueryBuilder('e')
            ->select('e', 'p', 'c')
            ->leftJoin('e.person', 'p')
            ->leftJoin('e.category', 'c')
            ->where('p.shareGroup = :group')
            ->setParameter(':group', $shareGroup)
            ->getQuery()
            ->getArrayResult();

        return $this->json($expense);
    }


    /**
     * @Route("/", name="expense_new", methods="POST")
     */
    public function new(Request $request)
    {
        $data = $request->getContent();

        $jsonData = json_decode($data, true);

        $em = $this->getDoctrine()->getManager();

        $shareGroup = $em->getRepository(ShareGroup::class)->findOneBySlug($jsonData["slug"]);
        $person = $em->getRepository(Person::class)->find($jsonData["id"]);
        $category = $em->getRepository(Category::class)->find($jsonData["id"]);

        $expense = new Expense();
        $expense->setTitle($jsonData["title"]);
        $expense->setAmount($jsonData["amount"]);
        $expense->setCategory($category);
        $expense->setPerson($person);


        $em->persist($expense);
        $em->flush();

        return $this->json($this->serialize($expense));
    }

}
