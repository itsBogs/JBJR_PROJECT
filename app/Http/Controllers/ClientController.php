<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return $this->greetings();
    }

    public function show(string $section)
    {
        return match ($section) {
            'greetings', 'clientGreetings' => $this->greetings(),
            'clientDashboard' => $this->clientDashboard(),
            'clientProfile' => $this->clientProfile(),
            'clientAboutUs' => $this->clientAboutUs(),
            default => abort(404),
        };
    }

    public function greetings()
    {
        $client = [
            'name' => 'JBJR Trading Co.',
            'contactPerson' => 'Jayson Bogs',
            'industry' => 'Logistics & Supply Chain',
            'location' => 'Dagupan City, Pangasinan',
        ];

        $nextSteps = [
            [
                'label' => 'Review Dashboard',
                'description' => 'Check operational KPIs for this sprint.',
                'url' => route('client.show', 'clientDashboard'),
            ],
            [
                'label' => 'Update Profile',
                'description' => 'Ensure contact data is up to date.',
                'url' => route('client.show', 'clientProfile'),
            ],
            [
                'label' => 'Share About Us',
                'description' => 'Send stakeholders a quick overview deck.',
                'url' => route('client.show', 'clientAboutUs'),
            ],
        ];

        $highlights = [
            'Weekly fulfillment SLA stayed above 98%.',
            'Five new partner requests awaiting review.',
            'New sustainability milestone logged for Q1.',
        ];

        return $this->renderAjaxOrView('greetings', compact('client', 'nextSteps', 'highlights'));
    }

    public function clientProfile()
    {
        $profile = [
            'name' => 'Jayson Bogs',
            'role' => 'Operations Lead',
            'email' => 'ops@jbjr.com',
            'phone' => '+63 917 000 1234',
            'location' => 'Pangasinan, PH',
            'plan' => 'Enterprise Tier',
        ];

        $preferences = [
            'Weekly executive digest every Monday 8AM.',
            'Notify via SMS for urgent shipment delays.',
            'Share dashboards with finance automatically.',
        ];

        $activity = [
            ['time' => '09:24', 'detail' => 'Approved procurement summary for March.'],
            ['time' => '08:10', 'detail' => 'Exported fulfillment report to PDF.'],
            ['time' => 'Yesterday', 'detail' => 'Invited finance@jbjr.com to the workspace.'],
        ];

        return $this->renderAjaxOrView('clientProfile', compact('profile', 'preferences', 'activity'));
    }

    public function clientAboutUs()
    {
        $company = [
            'tagline' => 'Delivering reliable fulfillment data since 2015.',
            'mission' => 'Empower regional enterprises with transparent logistics intelligence.',
            'vision' => 'Seamless end-to-end shipment visibility across Luzon by 2030.',
        ];

        $values = [
            'Clarity first — we simplify decisions with clean data.',
            'Move with empathy — clients, riders, and recipients matter equally.',
            'Build momentum — every release should remove a daily friction.',
        ];

        $timeline = [
            ['year' => '2015', 'event' => 'Started as a two-person warehouse analytics team.'],
            ['year' => '2018', 'event' => 'Expanded to Northern Luzon with four satellite hubs.'],
            ['year' => '2022', 'event' => 'Processed the one-millionth delivery insight.'],
            ['year' => '2025', 'event' => 'Launched sustainability tracker with CO₂ insights.'],
        ];

        return $this->renderAjaxOrView('clientAboutUs', compact('company', 'values', 'timeline'));
    }

    public function clientDashboard()
    {
        $metrics = [
            ['label' => 'Active Orders', 'value' => 42, 'trend' => '+8% WoW'],
            ['label' => 'On-time Deliveries', 'value' => '96%', 'trend' => '+2% WoW'],
            ['label' => 'Warehouse Capacity', 'value' => '78%', 'trend' => 'Stable'],
            ['label' => 'Support Tickets', 'value' => 5, 'trend' => '-3 vs last week'],
        ];

        $tasks = [
            ['title' => 'Approve shipment #4471 rollout plan', 'due' => 'Today', 'status' => 'Pending'],
            ['title' => 'Upload signed SLA renewal', 'due' => 'Tomorrow', 'status' => 'In Review'],
            ['title' => 'Share Q1 KPI recap deck', 'due' => 'Friday', 'status' => 'Draft'],
        ];

        $alerts = [
            'Heads up: Dagupan warehouse hits buffer threshold at 6PM.',
            'Two riders flagged for overtime — confirm adjustments.',
        ];

        return $this->renderAjaxOrView('clientDashboard', compact('metrics', 'tasks', 'alerts'));
    }
}
