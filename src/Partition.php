<?php

namespace Tonyco\Composer;

use Composer\Script\Event;

class Partition
{
    public static function generate(Event $event)
    {
        $io = $event->getIO();
        $packages = $event->getComposer()->getRepositoryManager()->getLocalRepository()->getPackages();
        $requires = $event->getComposer()->getPackage()->getRequires();

        // the packages and the required dependencies does not have all information
        // so we have to use both arrays to extract needed details
        foreach ($requires as $i => $require) {
            /** @var $require \Composer\Package\Link **/
            $search = array_filter(
                $packages,
                function ($e) use($require) {
                    return $e->getName() == $require->getTarget();
                }
            );

            if (!empty($search)) {
                $package = current($search);
                /** @var $package \Composer\Package\Package **/
                $io->write('<info>name</info>       : ' . '<comment>'.$package->getPrettyName().'</comment>', true);
                $io->write('<info>descrip.</info>   : ' . $package->getDescription(), true);
                $io->write('<info>license</info>    : ' . implode(', ', $package->getLicense()), true);
                $io->write('<info>version</info>    : ' . $package->getPrettyVersion(), true);
                $io->write('<info>constraint</info> : ' . $require->getPrettyConstraint(), true);
                $io->write('<info>source</info>     : ' . $package->getSourceUrl(), true);
                $io->write('<info>homepage</info>   : ' . ($package->getHomepage() ? $package->getHomepage() : str_replace(".git", "", $package->getSourceUrl())), true);

                $subRequires = implode(', ', array_map(function ($package) {
                    return $package->getTarget();
                }, $package->getRequires()));

                $io->write('<info>requires</info>   : ' . ($subRequires ? $subRequires : 'none'), true);

                $io->write('', true);
            }
        }
    }
}
