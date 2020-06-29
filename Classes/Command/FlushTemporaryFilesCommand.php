<?php

namespace Fab\MediaUpload\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Fab\MediaUpload\FileUpload\UploadManager;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Object\ObjectManagerInterface;

class FlushTemporaryFilesCommand extends Command
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
            "Flush all temporary files  "
        );
        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $this->uploadManager = $this->objectManager->get(UploadManager::class);
    }

    /**
     * Executes the command to flush all temporary files
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int error code
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $structure = $this->uploadManager->getStructureOfFiles();

        GeneralUtility::rmdir(GeneralUtility::getFileAbsFileName(UploadManager::UPLOAD_FOLDER), true);
        GeneralUtility::mkdir_deep(GeneralUtility::getFileAbsFileName(UploadManager::UPLOAD_FOLDER));
        
        $output->writeln(sprintf("<fg=green>Successfully removed %s file(s).</>", $structure['numberOfFiles']));
    }
}