<?php

return [
    /**
     * Fee required to become a seller
     */
    'minbid_fee' => '100',
    'bid_fee' => 0.05,
    'seller_fee' => '300',

    /**
     * Commission fee
     */
    'market_fee' => [
        'min' => 0.04,
        'max' => 0.05,
    ],

    /**
     * Monero daemon
     */
    'monero' => [
        'host' => '127.0.0.1',
        'port' => '18083',
        'user' => 'monero-qwerasdf',
        'password' => 'qwerqwerqwer',
    ],

    'days_bid_ranking' => 1,
    'days_bid_delete' => 7,

    /**
     * After how long will orders with the status "waiting" be canceled
     */
    'days_cancel_orders' => 1,

    /**
     * After how long will orders with the status "shipped" be finalized
     */
    'days_complete_orders' => 14,
    'days_complete_orders_d' => 7,

    /**
     * After how many days old completed orders will be deleted
     */
    'days_delete_old_order' => 7,

    /**
     * After how many days old messages will be destroyed
     */
    'days_delete_conversations' => 30,

    /**
     * All possible statuses for the order
     */
    'order_status' => [
        'waiting',
        'accepted',
        'purchased',
        'shipped',
        'delivered',
        'canceled',
        'disputed',
    ],

    /**
     * Main cases of complaint
     */
    'reporting_causes' => [
        'prohibited_product' => 'prohibited product',
        'scam_attempt' => 'scam attempt',
        'fake_feedback' => 'fake feedback',
        'violates_market_rules' => 'violates market rules',
        'other' => 'other',
    ],

    /**
     * Feedback types
     */
    'feedback_type' => ['negative', 'neutral', 'positive'],

    /**
     * Order
     */
    'order_by' => ['newest', 'oldest'],

    /**
     * Footer links
     */
    'dread_forum_link' => null,

    'wiki_link' => null,
];