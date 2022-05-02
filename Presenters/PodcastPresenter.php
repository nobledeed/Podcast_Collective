<?php
namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums;
use App\Models\PodcastFacade;

class PodcastPresenter extends Nette\Application\UI\Presenter
{
	private $facade;

	public function __construct(PodcastFacade $facade)
	{
		$this->facade = $facade;
	}

	public function renderTablecontents(): void
{
	$this->template->podcasts = $this->facade
		->getAllPodcasts();
}

	public function renderShow($podcastId): void
	{
	
		$this->template->podcast = $this->facade
		->getAllPodcasts()->get($podcastId);

	}
	public function actionAdd(): void
	{
		$form = $this->getComponent('podcastForm');
		$form->onSuccess[] = [$this, 'addFormSucceeded'];
	}

	public function actionEdit(int $podcastId): void
	{
		$podcast = $this->facade->getAllPodcasts()->get($podcastId);
		

		$form = $this->getComponent('podcastForm');
		$form->setDefaults($podcast); // set defaults
		$form->onSuccess[] = [$this, 'editFormSucceeded'];
	}

	protected function createComponentPodcastForm(): Form
	{
		BootstrapForm::switchBootstrapVersion(Enums\BootstrapVersion::V5);
        $form = new BootstrapForm;

		$form->addText('title', 'Title:')
            ->setRequired();
        $form->addTextArea('content', 'Content:')
            ->setRequired();

	    if ($this->getAction() === 'add'){

			$form->addButton('placeholder','Save')
            ->setHtmlAttribute('hx-post','/podcast/add/')
            ->setOmitted();
			
		} elseif ($this->getAction() === 'edit'){

			$form->addButton('placeholder','Save changes')
            ->setHtmlAttribute('hx-post','/podcast/edit?podcastId='.$this->getParameter('podcastId'))
            ->setOmitted();
			
		}


		return $form;
	}

	public function addFormSucceeded(Form $form, array $data): void
	{
		$podcast = $this->facade->getAllPodcasts()->insert($data); // add record to database
		$this->flashMessage('Successfully added');
        $this->forward('Podcast:tablecontents');
	}

	public function editFormSucceeded(Form $form, array $data): void
	{
		$podcastId = (int) $this->getParameter('podcastId');
		$this->facade->getAllPodcasts()->get($podcastId)->update($data); // update record
		$this->flashMessage('Successfully updated');
		$this->forward('Podcast:tablecontents');
	}

	protected function createComponentDeleteForm(): Form
	{
		BootstrapForm::switchBootstrapVersion(Enums\BootstrapVersion::V5);
        $form = new BootstrapForm;
	
		$form->addButton('cancel','Cancel')
		->setHtmlAttribute('hx-post','/podcast/cancelled/')
		->setOmitted();
		$form->addButton('delete')
            ->setHtmlAttribute('hx-post','/podcast/delete?podcastId='.$this->getParameter('podcastId'))
			->setOmitted();
		
			
			
			$form->onSuccess[] = [$this, 'deleteFormSucceeded'];

		return $form;
	}

    public function renderDelete(int $podcastId): void
    {
       $podcast = $this->facade->getAllPodcasts()->get($podcastId);
            
            
        if (!$podcast) {
            $this->error('Podcast not found');
        }
        $this->template->podcast = $podcast;
        $this->getComponent('deleteForm')
            ->setDefaults($podcast->toArray());
    }

	public function deleteFormSucceeded(): void
	{
		$podcastId = (int) $this->getParameter('podcastId');

        if ($podcastId) {
            $podcast = $this->facade->getAllPodcasts()->get($podcastId);
            $podcast->delete();
        
		
		$this->flashMessage('Podcast has been deleted.');
		$this->forward('Podcast:tablecontents');
	}
	else{
		$this->flashMessage('Podcast not found.');
		$this->forward('Podcast:tablecontents');
	}
	}

    public function actionCancelled(): void
	{
		$this->forward('Podcast:tablecontents');
	}
	
}
