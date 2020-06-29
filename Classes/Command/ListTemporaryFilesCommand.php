<?php

namespace Fab\MediaUpload\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Fab\MediaUpload\FileUpload\UploadManager;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Object\ObjectManagerInterface;

class ListTemporaryFilesCommand extends Command
{
    /**
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var UploadManager
     */
    protected $uploadManager;

    /**
     * Configure the command by defining the name, options and arguments
     */
    protected function configure()
    {
        $this->setHelp(
            'List all temporary files'
        );
        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $this->uploadManager = $this->objectManager->get(UploadManager::class);
    }

    /**
     * Executes the command to list all temporary files
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int error code
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $structure = $this->uploadManager->getStructureOfFiles();
        if ($structure['numberOfFiles'] == 0) {
            $output->writeln('There are no temporary files in: ' . UploadManager::UPLOAD_FOLDER);
        }
        if ($structure['numberOfFiles'] > 0) {
            $output->writeln(implode(PHP_EOL, $structure['files']));
        }
        
    }
}