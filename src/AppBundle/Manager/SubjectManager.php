<?php

namespace AppBundle\Manager;

class SubjectManager
{
    protected $em;
    protected $router;

    public function __construct($em, $router)
    {
        $this->em = $em;
        $this->router = $router;
    }

    public function childrenHierarchy()
    {
        $subjects = $this->getRepository()->childrenHierarchy();

        return $this->getHierarchyElement($subjects);
    }

    protected function getHierarchyElement($subjects)
    {
        $childrenHierarchy = array();

        foreach ($subjects as $subject) {
            $node = array(
                'text' => $subject['label'],
                'href' => $this->router->generate('homepage', array('id' => $subject['id'])),
            );

            if(count($subject['__children'])){
                $node['nodes'] = $this->getHierarchyElement($subject['__children']);
            }

            $childrenHierarchy[] = $node;
        }

        return $childrenHierarchy;
    }

    public function getRepository()
    {
        return $this->em->getRepository('AppBundle:Subject');
    }
}