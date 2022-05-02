<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Models\PodcastFacade;
use Nette;


final class LandingpagePresenter extends Nette\Application\UI\Presenter
{
    private $facade;

	public function __construct(PodcastFacade $facade)
	{
		$this->facade = $facade;
	}

    public function renderWelcome(): void
{
	$this->template->podcasts = $this->facade
		->getAllPodcasts()->limit(3);
}


}