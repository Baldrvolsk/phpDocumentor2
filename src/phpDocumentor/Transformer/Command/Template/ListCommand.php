<?php
/**
 * phpDocumentor
 *
 * PHP Version 5.3
 *
 * @copyright 2010-2018 Mike van Riel / Naenius (http://www.naenius.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */

namespace phpDocumentor\Transformer\Command\Template;

use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Output\OutputInterface;
use phpDocumentor\Command\Command;
use phpDocumentor\Transformer\Template\Factory;

/**
 * Lists all templates known to phpDocumentor.
 */
class ListCommand extends Command
{
    /** @var Factory Template factory providing all known template definitions */
    private $factory;

    /**
     * Initializes this command with its dependencies.
     */
    public function __construct(Factory $factory)
    {
        parent::__construct('template:list');

        $this->factory = $factory;
    }

    /**
     * Initializes this command and sets the name, description, options and arguments.
     */
    protected function configure()
    {
        $this->setName('template:list')
            ->setDescription(
                'Displays a listing of all available templates in phpDocumentor'
            )
            ->setHelp(
<<<HELP
This task outputs a list of templates as available in phpDocumentor.
Please mind that custom templates which are situated outside phpDocumentor are not
shown in this listing.
HELP
            );
    }

    /**
     * Retrieves all template names from the Template Factory and sends those to stdout.
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Available templates:');
        foreach ($this->factory->getAllNames() as $template_name) {
            $output->writeln('* ' . $template_name);
        }

        $output->writeln('');
    }
}
