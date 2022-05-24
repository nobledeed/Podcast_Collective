<?php

namespace App\Presenters;

use Nette;

use Nette\Application\UI\Form;
use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums;
use App\Models\PodcastAuthenticator;


final class SignPresenter extends Nette\Application\UI\Presenter
{
	
	private $authenticator;

	public function __construct(PodcastAuthenticator $authenticator)
	{
		$this->authenticator = $authenticator;
	}


    protected function createComponentSigninForm(): Form

    {
        BootstrapForm::switchBootstrapVersion(Enums\BootstrapVersion::V5);
        $form = new BootstrapForm;
        $form->addEmail('username', 'Email:')
        ->setRequired('Please enter your Email');
        $form->addPassword('password','Password:')
        ->setRequired('Please enter your Password');

        $form->addSubmit('send','Sign In');
     

        $form->onSuccess[] = [$this, 'signInFormSucceeded'];
		return $form;

        
    }
    public function signInFormSucceeded(Form $form, \stdClass $data): void
    {
        try {
            $this->getUser()->setAuthenticator($this->authenticator)
            ->login($data->username, $data->password);
            $this->redirect('Landingpage:welcome');
    
        } catch (Nette\Security\AuthenticationException $e) {
            $form->addError('Incorrect username or password.');
        }
    }
    protected function createComponentSignupForm(): Form
    {
        BootstrapForm::switchBootstrapVersion(Enums\BootstrapVersion::V5);
        $form = new BootstrapForm;
        $form->addEmail('username', 'Email:')
            ->setRequired();
            $passwordInput = $form->addPassword('password', 'Password')->setRequired('Please enter a password');
            $form->addPassword('pwd2', 'Password (verify)')->setRequired('Please enter password for verification')
            ->addRule($form::EQUAL, 'Password verification failed. Passwords do not match', $passwordInput);

        $form->addSubmit('send', 'Submit');
        $form->onSuccess[] = [$this, 'signupFormSucceeded'];

        return $form;
    }
    

    public function signupFormSucceeded(array $data): void
    {
            

           $this->authenticator->createUser($data['username'], $data['password']);
       
            $this->flashMessage('Welcome! You are all signed up!', 'success');
            $this->redirect('Landingpage:welcome');
        

    }
        
    public function actionOut(): void
    {
        $this->getUser()->logout();
        $this->flashMessage('You have been signed out.');
        $this->redirect('Landingpage:welcome');
    }


}