<?php
namespace Stagehand\TestRunner\DependencyInjection;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InactiveScopeException;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * PHPSpecContainer
 *
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 */
class PHPSpecContainer extends Container
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct(new ParameterBag($this->getDefaultParameters()));
    }

    /**
     * Gets the 'alteration_monitoring' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Object A %alteration_monitoring.class% instance.
     */
    protected function getAlterationMonitoringService()
    {
        $class = $this->getParameter('alteration_monitoring.class');

        return $this->services['alteration_monitoring'] = new $class();
    }

    /**
     * Gets the 'collecting_type' service.
     *
     * @return Object A %collecting_type.class% instance.
     */
    protected function getCollectingTypeService()
    {
        $class = $this->getParameter('collecting_type.class');

        $instance = new $class();

        $instance->setLegacyProxy($this->get('legacy_proxy'));

        return $instance;
    }

    /**
     * Gets the 'collecting_type_factory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Object A %collecting_type_factory.class% instance.
     */
    protected function getCollectingTypeFactoryService()
    {
        return $this->services['collecting_type_factory'] = $this->get('component_aware_factory_factory')->create('collecting_type', $this->getParameter('collecting_type_factory.class'));
    }

    /**
     * Gets the 'command_line_builder' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Object A %command_line_builder.class% instance.
     */
    protected function getCommandLineBuilderService()
    {
        $class = $this->getParameter('command_line_builder.class');

        return $this->services['command_line_builder'] = new $class($this->get('environment'), $this->get('legacy_proxy'), $this->get('os'), $this->get('plugin'), $this->get('phpspec.runner'), $this->get('terminal'), $this->get('test_target_repository'), NULL);
    }

    /**
     * Gets the 'component_aware_factory_factory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Object A %component_aware_factory_factory.class% instance.
     */
    protected function getComponentAwareFactoryFactoryService()
    {
        $class = $this->getParameter('component_aware_factory_factory.class');

        $this->services['component_aware_factory_factory'] = $instance = new $class();

        $instance->setFactoryClass($this->getParameter('component_aware_factory.class'));
        $instance->setComponentFactory($this->get('component_factory'));

        return $instance;
    }

    /**
     * Gets the 'component_factory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @throws RuntimeException always since this service is expected to be injected dynamically
     */
    protected function getComponentFactoryService()
    {
        throw new RuntimeException('You have requested a synthetic service ("component_factory"). The DIC does not know how to construct this service.');
    }

    /**
     * Gets the 'continuous_test_runner' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Object A %continuous_test_runner.class% instance.
     */
    protected function getContinuousTestRunnerService()
    {
        $class = $this->getParameter('continuous_test_runner.class');

        $this->services['continuous_test_runner'] = $instance = new $class($this->get('phpspec.preparer'), $this->get('command_line_builder'));

        $instance->setAlterationMonitoring($this->get('alteration_monitoring'));
        $instance->setLegacyProxy($this->get('legacy_proxy'));
        $instance->setNotifier($this->get('notifier'));
        $instance->setOS($this->get('os'));
        $instance->setRunner($this->get('phpspec.runner'));
        $instance->setTestTargetRepository($this->get('test_target_repository'));
        $instance->setWatchDirs($this->getParameter('continuous_testing_watch_dirs'));

        return $instance;
    }

    /**
     * Gets the 'environment' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @throws RuntimeException always since this service is expected to be injected dynamically
     */
    protected function getEnvironmentService()
    {
        throw new RuntimeException('You have requested a synthetic service ("environment"). The DIC does not know how to construct this service.');
    }

    /**
     * Gets the 'input' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @throws RuntimeException always since this service is expected to be injected dynamically
     */
    protected function getInputService()
    {
        throw new RuntimeException('You have requested a synthetic service ("input"). The DIC does not know how to construct this service.');
    }

    /**
     * Gets the 'legacy_proxy' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Object A %legacy_proxy.class% instance.
     */
    protected function getLegacyProxyService()
    {
        $class = $this->getParameter('legacy_proxy.class');

        return $this->services['legacy_proxy'] = new $class();
    }

    /**
     * Gets the 'notifier' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Object A %notifier.class% instance.
     */
    protected function getNotifierService()
    {
        $class = $this->getParameter('notifier.class');

        $this->services['notifier'] = $instance = new $class();

        $instance->setLegacyProxy($this->get('legacy_proxy'));
        $instance->setOS($this->get('os'));

        return $instance;
    }

    /**
     * Gets the 'os' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Object A %os.class% instance.
     */
    protected function getOsService()
    {
        $class = $this->getParameter('os.class');

        $this->services['os'] = $instance = new $class();

        $instance->setLegacyProxy($this->get('legacy_proxy'));

        return $instance;
    }

    /**
     * Gets the 'output' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @throws RuntimeException always since this service is expected to be injected dynamically
     */
    protected function getOutputService()
    {
        throw new RuntimeException('You have requested a synthetic service ("output"). The DIC does not know how to construct this service.');
    }

    /**
     * Gets the 'output_buffering' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Object A %output_buffering.class% instance.
     */
    protected function getOutputBufferingService()
    {
        $class = $this->getParameter('output_buffering.class');

        $this->services['output_buffering'] = $instance = new $class();

        $instance->setLegacyProxy($this->get('legacy_proxy'));

        return $instance;
    }

    /**
     * Gets the 'phpspec.collector' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Object A %phpspec.collector.class% instance.
     */
    protected function getPhpspec_CollectorService()
    {
        $class = $this->getParameter('phpspec.collector.class');

        $this->services['phpspec.collector'] = $instance = new $class($this->get('test_target_repository'));

        $instance->setCollectingTypeFactory($this->get('collecting_type_factory'));
        $instance->setEnvironment($this->get('environment'));
        $instance->setRecursive($this->getParameter('recursive'));

        return $instance;
    }

    /**
     * Gets the 'phpspec.preparer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Object A %phpspec.preparer.class% instance.
     */
    protected function getPhpspec_PreparerService()
    {
        $class = $this->getParameter('phpspec.preparer.class');

        return $this->services['phpspec.preparer'] = new $class();
    }

    /**
     * Gets the 'phpspec.runner' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Object A %phpspec.runner.class% instance.
     */
    protected function getPhpspec_RunnerService()
    {
        $class = $this->getParameter('phpspec.runner.class');

        $this->services['phpspec.runner'] = $instance = new $class();

        $instance->setDetailedProgress($this->getParameter('detailed_progress'));
        $instance->setJUnitXMLFile($this->getParameter('junit_xml_file'));
        $instance->setJUnitXMLRealtime($this->getParameter('junit_xml_realtime'));
        $instance->setNotify($this->getParameter('notify'));
        $instance->setStopOnFailure($this->getParameter('stop_on_failure'));
        $instance->setTerminal($this->get('terminal'));
        $instance->setTestTargetRepository($this->get('test_target_repository'));

        return $instance;
    }

    /**
     * Gets the 'plugin' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @throws RuntimeException always since this service is expected to be injected dynamically
     */
    protected function getPluginService()
    {
        throw new RuntimeException('You have requested a synthetic service ("plugin"). The DIC does not know how to construct this service.');
    }

    /**
     * Gets the 'terminal' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Object A %terminal.class% instance.
     */
    protected function getTerminalService()
    {
        $class = $this->getParameter('terminal.class');

        $this->services['terminal'] = $instance = new $class();

        $instance->setInput($this->get('input'));
        $instance->setOutput($this->get('output'));

        return $instance;
    }

    /**
     * Gets the 'test_runner' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Object A %test_runner.class% instance.
     */
    protected function getTestRunnerService()
    {
        $class = $this->getParameter('test_runner.class');

        $this->services['test_runner'] = $instance = new $class($this->get('phpspec.preparer'));

        $instance->setCollector($this->get('phpspec.collector'));
        $instance->setNotifier($this->get('notifier'));
        $instance->setRunner($this->get('phpspec.runner'));
        $instance->setOutputBuffering($this->get('output_buffering'));

        return $instance;
    }

    /**
     * Gets the 'test_target_repository' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Object A %test_target_repository.class% instance.
     */
    protected function getTestTargetRepositoryService()
    {
        $class = $this->getParameter('test_target_repository.class');

        $this->services['test_target_repository'] = $instance = new $class($this->get('plugin'));

        $instance->setClasses($this->getParameter('test_classes'));
        $instance->setFilePattern($this->getParameter('test_file_pattern'));
        $instance->setMethods($this->getParameter('test_methods'));
        $instance->setResources($this->getParameter('test_resources'));

        return $instance;
    }

    /**
     * Gets the collector service alias.
     *
     * @return Object An instance of the phpspec.collector service
     */
    protected function getCollectorService()
    {
        return $this->get('phpspec.collector');
    }

    /**
     * Gets the preparer service alias.
     *
     * @return Object An instance of the phpspec.preparer service
     */
    protected function getPreparerService()
    {
        return $this->get('phpspec.preparer');
    }

    /**
     * Gets the runner service alias.
     *
     * @return Object An instance of the phpspec.runner service
     */
    protected function getRunnerService()
    {
        return $this->get('phpspec.runner');
    }

    /**
     * Gets the default parameters.
     *
     * @return array An array of the default parameters
     */
    protected function getDefaultParameters()
    {
        return array(
            'component_aware_factory.class' => 'Stagehand\\ComponentFactory\\ComponentAwareFactory',
            'component_aware_factory_factory.class' => 'Stagehand\\ComponentFactory\\ComponentAwareFactoryFactory',
            'alteration_monitoring.class' => 'Stagehand\\TestRunner\\Process\\ContinuousTesting\\AlterationMonitoring',
            'collecting_type.class' => 'Stagehand\\TestRunner\\Collector\\CollectingType',
            'collecting_type_factory.class' => 'Stagehand\\TestRunner\\Collector\\CollectingTypeFactory',
            'command_line_builder.class' => 'Stagehand\\TestRunner\\Process\\ContinuousTesting\\CommandLineBuilder',
            'continuous_test_runner.class' => 'Stagehand\\TestRunner\\Process\\ContinuousTesting\\ContinuousTestRunner',
            'legacy_proxy.class' => 'Stagehand\\TestRunner\\Util\\LegacyProxy',
            'notifier.class' => 'Stagehand\\TestRunner\\Notification\\Notifier',
            'os.class' => 'Stagehand\\TestRunner\\Util\\OS',
            'output_buffering.class' => 'Stagehand\\TestRunner\\Util\\OutputBuffering',
            'terminal.class' => 'Stagehand\\TestRunner\\CLI\\Terminal',
            'test_runner.class' => 'Stagehand\\TestRunner\\Process\\TestRunner',
            'test_target_repository.class' => 'Stagehand\\TestRunner\\Core\\TestTargetRepository',
            'recursive' => false,
            'continuous_testing' => false,
            'continuous_testing_watch_dirs' => array(

            ),
            'notify' => false,
            'test_methods' => array(

            ),
            'test_classes' => array(

            ),
            'junit_xml_file' => NULL,
            'junit_xml_realtime' => false,
            'stop_on_failure' => false,
            'test_file_pattern' => NULL,
            'test_resources' => array(

            ),
            'detailed_progress' => false,
            'phpspec.collector.class' => 'Stagehand\\TestRunner\\Collector\\PHPSpecCollector',
            'phpspec.preparer.class' => 'Stagehand\\TestRunner\\Preparer\\PHPSpecPreparer',
            'phpspec.runner.class' => 'Stagehand\\TestRunner\\Runner\\PHPSpecRunner',
        );
    }
}
