<?php
/**
 * @copyright © TMS-Plugins. All rights reserved.
 * @licence   See COPYING.md for license details.
 */

namespace AmeliaBooking\Infrastructure\Routes;

use AmeliaBooking\Infrastructure\Routes\Activation\Activation;
use AmeliaBooking\Infrastructure\Routes\Bookable\Category;
use AmeliaBooking\Infrastructure\Routes\Bookable\Extra;
use AmeliaBooking\Infrastructure\Routes\Bookable\Package;
use AmeliaBooking\Infrastructure\Routes\Bookable\Resource;
use AmeliaBooking\Infrastructure\Routes\Bookable\Service;
use AmeliaBooking\Infrastructure\Routes\Booking\Appointment\Appointment;
use AmeliaBooking\Infrastructure\Routes\Booking\Booking;
use AmeliaBooking\Infrastructure\Routes\Booking\Event\Event;
use AmeliaBooking\Infrastructure\Routes\Coupon\Coupon;
use AmeliaBooking\Infrastructure\Routes\Import\Import;
use AmeliaBooking\Infrastructure\Routes\Outlook\Outlook;
use AmeliaBooking\Infrastructure\Routes\Payment\Refund;
use AmeliaBooking\Infrastructure\Routes\Stash\Stash;
use AmeliaBooking\Infrastructure\Routes\Stats\Stats;
use AmeliaBooking\Infrastructure\Routes\Location\Location;
use AmeliaBooking\Infrastructure\Routes\Notification\Notification;
use AmeliaBooking\Infrastructure\Routes\Payment\Payment;
use AmeliaBooking\Infrastructure\Routes\PaymentGateway\PaymentGateway;
use AmeliaBooking\Infrastructure\Routes\Search\Search;
use AmeliaBooking\Infrastructure\Routes\Settings\Settings;
use AmeliaBooking\Infrastructure\Routes\Entities\Entities;
use AmeliaBooking\Infrastructure\Routes\Test\Test;
use AmeliaBooking\Infrastructure\Routes\TimeSlots\TimeSlots;
use AmeliaBooking\Infrastructure\Routes\User\User;
use AmeliaBooking\Infrastructure\Routes\Report\Report;
use AmeliaBooking\Infrastructure\Routes\Google\Google;
use AmeliaBooking\Infrastructure\Routes\CustomField\CustomField;
use AmeliaBooking\Infrastructure\Routes\WhatsNew\WhatsNew;
use AmeliaBooking\Infrastructure\Routes\Zoom\Zoom;
use Slim\App;

/**
 * Class Routes
 *
 * API Routes for the Amelia app
 *
 * @package AmeliaBooking\Infrastructure\Routes
 */
class Routes
{
    /**
     * @param App $app
     *
     * @throws \InvalidArgumentException
     */
    public static function routes(App $app)
    {
        Activation::routes($app);

        Booking::routes($app);

        Appointment::routes($app);

        Event::routes($app);

        Category::routes($app);

        Entities::routes($app);

        Notification::routes($app);

        Payment::routes($app);

        Service::routes($app);

        Resource::routes($app);

        Settings::routes($app);

        TimeSlots::routes($app);

        User::routes($app);

        Stats::routes($app);

        Stash::routes($app);

        if (!AMELIA_LITE_VERSION) {
            Coupon::routes($app);

            Extra::routes($app);

            Google::routes($app);

            Outlook::routes($app);

            Location::routes($app);

            PaymentGateway::routes($app);

            Refund::routes($app);

            Report::routes($app);

            Search::routes($app);

            CustomField::routes($app);

            Package::routes($app);
        }

        Import::routes($app);

        Zoom::routes($app);

        WhatsNew::routes($app);

        Test::routes($app);
    }
}
