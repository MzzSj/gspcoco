<?php
/**
 * Handle WP part of appointment-related events
 */

namespace AmeliaBooking\Infrastructure\WP\EventListeners\Booking\Appointment;

use AmeliaBooking\Application\Commands\CommandResult;
use AmeliaBooking\Infrastructure\Common\Container;
use AmeliaBooking\Infrastructure\WP\Integrations\ThriveAutomator\ThriveAutomatorService;
use League\Event\ListenerInterface;
use League\Event\EventInterface;

/**
 * Class AppointmentEventsListener
 *
 * @package AmeliaBooking\Infrastructure\WP\EventListeners\Booking\Appointment
 */
class AppointmentEventsListener implements ListenerInterface
{
    /** @var Container */
    private $container;

    /**
     * AppointmentEventsListener constructor.
     *
     * @param Container $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * Check if provided argument is the listener
     *
     * @param mixed $listener
     *
     * @return bool
     */
    public function isListener($listener)
    {
        return $listener === $this;
    }

    /**
     * @param EventInterface     $event
     * @param CommandResult|null $param
     *
     * @throws \Slim\Exception\ContainerValueNotFoundException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\NotFoundException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \Exception
     * @throws \Exception
     */
    public function handle(EventInterface $event, $param = null)
    {
        // Handling the events
        if ($param->getResult() !== 'error') {
            if (!AMELIA_LITE_VERSION) {
                ThriveAutomatorService::initItems();
            }

            switch ($event->getName()) {
                case 'AppointmentAdded':
                    do_action('AmeliaAppointmentAddedBeforeNotify', $param->getData(), $this->container);
                    AppointmentAddedEventHandler::handle($param, $this->container);
                    break;
                case 'AppointmentDeleted':
                    foreach (["appointment", "event", "booking"] as $type) {
                        if (isset($param->getData()[$type]) &&
                            in_array($param->getData()[$type]["status"], ["canceled", "rejected", "deleted"])
                        ) {
                            return;
                        }
                    }

                    AppointmentDeletedEventHandler::handle($param, $this->container);
                    break;
                case 'AppointmentEdited':
                    AppointmentEditedEventHandler::handle($param, $this->container);
                    break;
                case 'AppointmentStatusUpdated':
                    foreach (["appointment", "event", "booking"] as $type) {
                        if (AMELIA_LITE_VERSION &&
                            isset($param->getData()[$type]) &&
                            in_array($param->getData()[$type]["status"], ["canceled", "rejected", "deleted"])
                        ) {
                            return;
                        }
                    }

                    AppointmentStatusUpdatedEventHandler::handle($param, $this->container);
                    break;
                case 'BookingTimeUpdated':
                    if (!AMELIA_LITE_VERSION) {
                        AppointmentTimeUpdatedEventHandler::handle($param, $this->container);
                    }

                    break;
                case 'BookingAdded':
                    do_action('AmeliaBookingAddedBeforeNotify', $param->getData(), $this->container);
                    BookingAddedEventHandler::handle($param, $this->container);
                    break;
                case 'BookingCanceled':
                    foreach (["appointment", "event", "booking"] as $type) {
                        if (AMELIA_LITE_VERSION &&
                            isset($param->getData()[$type]) &&
                            in_array($param->getData()[$type]["status"], ["canceled", "rejected", "deleted"])
                        ) {
                            return;
                        }
                    }

                    BookingCanceledEventHandler::handle($param, $this->container);
                    break;
                case 'BookingEdited':
                    BookingEditedEventHandler::handle($param, $this->container);
                    break;
                case 'BookingReassigned':
                    BookingReassignedEventHandler::handle($param, $this->container);
                    break;
                case 'BookingDeleted':
                    if ($param->getData()['appointmentDeleted']) {
                        AppointmentDeletedEventHandler::handle($param, $this->container);
                    } else if ($param->getData()['bookingDeleted']) {
                        AppointmentEditedEventHandler::handle($param, $this->container);
                    }
                    break;
                case 'PackageCustomerUpdated':
                    PackageCustomerUpdatedEventHandler::handle($param, $this->container);
                    break;
                case 'PackageCustomerAdded':
                    PackageCustomerAddedEventHandler::handle($param, $this->container);
                    break;
                case 'PackageCustomerDeleted':
                    $appointmentUpdatedResult = new CommandResult();

                    foreach ($param->getData()['appointments']['updatedAppointments'] as $item) {
                        $appointmentUpdatedResult->setData($item);

                        AppointmentEditedEventHandler::handle($appointmentUpdatedResult, $this->container);
                    }

                    PackageCustomerDeletedEventHandler::handle($param, $this->container);
                    break;
            }
        }
    }
}
