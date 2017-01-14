<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Collection\Collection;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        if (is_null($this->Auth->user('id')) && $this->request->action == 'home') {
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
        return parent::beforeFilter($event);
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Util');
        $this->Auth->allow(['logout', 'add', 'verify']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['CompletedGames']
        ]);
        $query = $this->Users->Numbers->find()->where(['user_id' => $id]);
        $query->select(['sum' => $query->func()->sum('points_awarded'), 'count' => $query->func()->count('*')]);
        $stats = $query->first();


        $this->set(compact('user', 'stats'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user->set('email_verification', $this->Util->randomString());
            $user = $this->Users->save($user);
            if ($user) {
                $this->Flash->success(__('The user has been saved.'));
                $email = new Email('default');
                $url = Router::url(['controller' => 'Users', 'action' => 'verify', $user->id, $user->email_verification], true);
                $email
                    ->to([$user->email])
                    ->subject('Please verify your email address')
                    ->helpers(['Url'])
                    ->template('default')
                    ->viewVars([
                        'body' => "Greetings $user->username,\nPlease visit $url to verify your email address"])
                    ->emailFormat('both')
                    ->send();

                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Your username or password is incorrect.');
        }
    }

    public function logout()
    {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }

    public function home()
    {
        $userId = $this->Auth->user('id');
        $user = $this->Users->get($userId, [
            'contain' => [
                'ActiveGames',
                'CompletedGames' => function ($q) {
                    return $q->select()->orderDesc('id')->limit(5);
                }],
        ]);
        $number = $this->Users->Numbers->find()->select(['user_id', 'difficulty'])->where(['user_id' => $userId])->last();
        $this->set(compact('user', 'number'));


    }

    public function verify($id, $code)
    {
        if ($this->Users->exists(['id' => $id])) {
            $user = $this->Users->get($id);
            if ($user->email_verification == null) {
                $this->Flash->error('Your email address has already been verified');
            } elseif ($user->email_verification == $code) {
                $user->set('email_verification', null);
                if ($this->Users->save($user)) {
                    $this->Flash->success('Your email address has been verified');
                } else {
                    $this->Flash->error('There was a problem verifying your email address. Please try again later.');
                }
            } else {
                unset($user);
            }
        }
        if (!isset($user)) {
            $this->Flash->error('Invalid verification URL');
        }
        return $this->redirect(['action' => 'home']);
    }
}
