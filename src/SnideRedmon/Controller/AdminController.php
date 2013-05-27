<?php

/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace SnideRedmon\Controller;

use SnideRedmon\Controller\Controller;

/**
 * Class AdminController
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class AdminController extends Controller
{   
    public function indexAction()
    {
        return $this->createView('admin/index', array());
    }

    public function flushAllAction()
    {
        try {
            $this->getWorker()->execute('flushAll');
            
            $this->setFlashMessage('success', 'Flush ALL executed successfully');
        }catch(\Exception $e) {
            $this->setFlashMessage('error', 'We have encountered an error : '.$e->getMessage());
        }
        
        return $this->redirect()->toRoute('snide_redmon_instance');
    }
    
    /**
     * Call flush DB command for the current instance and the current database
     * 
     * @param int $id Database index
     */
    public function flushDbAction($id)
    {
        try {
            $worker = $this->getWorker()->flushDB($id);
            
            $this->get('session')->setFlash('success', 'Flush DB on '.$worker->getInstance()->getDatabase($id)->getName().' executed successfully');
        }catch(\Exception $e) {
            $this->get('session')->setFlash('success', 'Une erreur s\'est produite : '.$e->getMessage());
        }
        
        return $this->redirect()->toRoute('snide_redmon_instance');
    }
}