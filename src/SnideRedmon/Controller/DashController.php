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
 * Class DashController
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class DashController extends Controller
{
	public function indexAction()
	{
		$instance = $this->getCurrentInstance();
        if($instance) {
           
            $worker = $this->getWorker();
            // Worker can be undefined if server went away
            // For the current instance or if there is no instance selected
            if($worker) {
                return $this->createView('dash/index', array(
                    'instance' => $worker->getInstance(),
                    'infos'    => $worker->getInfos(),
                    'slowLogs'  => $worker->getSlowLogs(),
                    'keyspace'  => $worker->getKeyspace()
                ));
            }
        }
        return $this->redirect()->toRoute('snide_redmon_instance');
	}

	public function clientAction()
	{
		$worker = $this->getWorker();
        // Worker can be undefined if server went away
        // For the current instance or if we have no instance selected
        if($worker) {
			return $this->createView('dash/client', array(
				'instance' => $worker->getInstance(),
				'clients'=> $worker->getClients()
			));
        }

        return $this->redirect()->toRoute('snide_redmon_instance');
	}

	/**
     * Render configuration list for the current instance
     */
    public function configurationAction()
    {
        $worker = $this->getWorker();
        // Worker can be undefined if server went away
        // For the current instance or if we have no instance selected
        if($worker) {
           return $this->createView('dash/configuration', array(
				'instance' => $worker->getInstance(),
				'configs'  => $worker->getConfiguration()
			));
        }
        
        return $this->redirect()->toRoute('snide_redmon_instance');
    }
}