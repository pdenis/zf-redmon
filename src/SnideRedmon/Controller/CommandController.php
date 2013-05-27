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

use Zend\Console\Request as ConsoleRequest;

/**
 * Class Controller
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class CommandController extends Controller
{
    public function executeAction()
    {
        $request = $this->getRequest();
        try {
            if (!$request instanceof ConsoleRequest){
                throw new \RuntimeException('You can only use this action from a console!');
            }

            $logger = $this->getLogger();
            $instances = $this->getManager()->findAll();
            
            if(is_array($instances)) {
                foreach($instances as $instance) {
                    $logger
                        ->setInstance($instance)
                        ->execute();
                }
            }

            printf('snide-redmon log : OK');
        }catch(\Exception $e) {
            printf('snide-redmon log : '.$e->getMessage());
        }
    }

    protected function getLogger()
    {
        return $this->getServiceLocator()->get('snide_redmon.logger.instance');
    }
}