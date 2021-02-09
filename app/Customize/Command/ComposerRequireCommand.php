<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * http://www.ec-cube.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Customize\Command;

use Eccube\Service\Composer\ComposerApiService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ComposerRequireCommand extends Command
{
    protected static $defaultName = 'eccube:composer:require';

    /**
     * @var ComposerApiService
     */
    private $composerService;

    public function __construct(ComposerApiService $composerService)
    {
        parent::__construct();
        $this->composerService = $composerService;
    }

    protected function configure()
    {
        $this->addArgument('package', InputArgument::REQUIRED)
            ->addArgument('version', InputArgument::OPTIONAL);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $packageName = $input->getArgument('package');
        if ($input->getArgument('version')) {
            $packageName .= ':'.$input->getArgument('version');
        }
        $this->composerService->execRequire($packageName, $output);
    }
}
