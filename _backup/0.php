<?php>
 /**
     * Ceci est 1 exmple 
     * Affiche en details d'un Auteur avec FindBY
     * @Route("/recherche", name="search")
    */
    public function recherche(AuteursRepository $auteursrepo  )
    {
        $auteurs =  $auteursrepo ->findBy(
            array('noms' => 'admin',), 
            array ('prenoms'=>"DESC"), 10,0);
        return $this->render('authors/search.html.twig', [
            'auteurs' => $auteurs,
        ]);
    }

    /**
     * Ceci est 1 exmple 
     * Affiche en details d'un Auteur avec FindOneBY
     * @Route("/recherche2", name="search")
    */
    public function recherche2(AuteursRepository $auteursrepo  )
    {
        $auteurs =  $auteursrepo ->findOneBy (array('noms' => 'admin',));
        return $this->render('authors/search.html.twig', 
        ['auteurs' => $auteurs,]
    );
    }


        /**
     * Ceci est 1 exmple 
     * Affiche en details d'un Auteur avec FindBYParamatre(Valeur)
     * @Route("/search", name="admin_user_show")
    */
            public function search(UserRepository $userrepo  ){

            $users =  $userrepo->findByUsername('admin');

            return $this->render('admin_user/index.html.twig', [
                'users' => $users,
            ]);
        } 
     
    /**
     * Ceci est 1 exmple 
     * Affiche en details un Auteur avec FindOneBYParamatre(Valeur)
     * @Route("/search2", name="admin_user_show")
    */

    public function search2(UserRepository $userepo){

            $users =  $userepo->findOneByEmail('admin@mail.com');

            return $this->render('admin_user/index.html.twig', [
                'users' => $users,
            ]);
        } 




    /**
     * @Route("/{id}", name="admin_user_show", methods={"GET"})
     */
  public function show(User $user): Response
  {
      return $this->render('admin_user/show.html.twig', [
          'user' => $user,
      ]);
  }



  /**
   * @Route("/{id}/edit", name="admin_user_edit", methods={"GET", "POST"})
   */
  public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
  {
      $form = $this->createForm(UserType::class, $user);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $entityManager->flush();

          return $this->redirectToRoute('admin_user_index', [], Response::HTTP_SEE_OTHER);
      }

      return $this->render('admin_user/edit.html.twig', [
          'user' => $user,
          'form' => $form->createView(),
      ]);
  }



   // /**
    //  * @return Articles[] Retourne un tableau d'objets d'articles publiés mais par Auteurs cette fois avec les
    //  */
    
    public function findPublishArticlesAuteurs()
    {
        $qb = $this->createQueryBuilder('a');
        $qb

            ->innerJoin('App\Entity\Auteurs',  'o', 'WITH', 'o = a.auteurs')
           // ->select('a.id', 'a.title', 'a.date', 'a.resume', 'a.status')
            ->where('a.status =:status ')
            ->setParameter('status', '1')
         //   ->setMaxResults(5)
            ->orderBy('a.title', 'ASC');
        return $qb->getQuery()->getResult();
    }
    
    // /**
    //  * @return Articles[] Retourne un tableau d'objets d'articles publiés par un seul Autuers
    //  */
        public function findPublishArticlesOneAuteurs()
    {
        $qb = $this->createQueryBuilder('a');
        $qb

            ->innerJoin('App\Entity\Auteurs',  'o', 'WITH', 'o = a.auteurs')
           // ->select('a.id', 'a.title', 'a.date', 'a.resume', 'a.status')
            ->where('a.status =:status ')
            ->setParameter('status', '1')
            ->andWhere('o.noms like :noms')
            ->setParameter('noms', 'Omega')
         //   ->setMaxResults(5)
            ->orderBy('a.title', 'ASC');
        return $qb->getQuery()->getResult();
    }
    

