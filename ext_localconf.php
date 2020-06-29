<?php
if (!defined('TYPO3_MODE')) die ('Access denied.');

call_user_func(function () {
    $configuration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['media_upload']);
    if (false === isset($configuration['autoload_typoscript']) || true === (bool)$configuration['autoload_typoscript']) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
            'media_upload',
            'constants',
            '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:media_upload/Configuration/TypoScript/constants.typoscript">'
        );
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
            'media_upload',
            'setup',
            '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:media_upload/Configuration/TypoScript/setup.typoscript">'
        );
    }

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Fab.media_upload',
        'Pi1',
        array(
            'MediaUpload' => 'upload',
        ),
        // non-cacheable actions
        array(
            'MediaUpload' => 'upload',
        )
    );
});