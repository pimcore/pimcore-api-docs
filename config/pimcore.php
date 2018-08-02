<?php

use Sami\RemoteRepository\GitHubRemoteRepository;
use Sami\Sami;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$getEnvVar = function (string $name, $default = null) {
    return getenv($name) ?: getenv('REDIRECT_' . $name) ?: $default;
};

$repoPath   = $getEnvVar('DOCS_REPO_PATH', __DIR__ . '/../tmp/pimcore');
$sourcePath = $getEnvVar('DOCS_SOURCE_PATH', $repoPath);
$buildPath  = $getEnvVar('DOCS_BUILD_PATH', __DIR__ . '/../../build');

$iterator = Finder::create()
    ->files()
    ->in($sourcePath)
    ->name('*.php')
    ->notName('simple_html_dom.php')
    ->notName('PDFreactor.class.php')
    ->notName('deprecated-class-names.php')
    ->notPath('**/cli/**/*')
    ->notPath('**/Resources/**/*')
    ->notPath('**/Tests/**/*')
    ->exclude([
        'cli',
        'config',
        'stubs',
        'tests',
        'static',
        'static6',
        'lib/Pimcore/Web2Print/Processor/api',
        'modules/extensionmanager/example-plugin',
    ]);

$versions = GitVersionCollection::create($repoPath)
    ->add('master')
    ->addFromTags(function ($tag) {
        // only v5 tags without suffix (e.g. no alpha, beta builds)
        if (preg_match('/^v5\.\d+\.\d+$/', $tag)) {
            return true;
        }

        return false;
    })
    ->add('pimcore4');

return new Sami($iterator, [
    'theme'                => 'default',
    'versions'             => $versions,
    'title'                => 'Pimcore API',
    'build_dir'            => $buildPath . '/static/pimcore/%version%',
    'cache_dir'            => $buildPath . '/cache/pimcore/%version%',
    'remote_repository'    => new GitHubRemoteRepository('pimcore/pimcore', $repoPath),
    'default_opened_level' => 2,
]);
