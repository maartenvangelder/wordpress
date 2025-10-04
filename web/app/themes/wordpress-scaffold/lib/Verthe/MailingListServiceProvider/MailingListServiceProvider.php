<?php

namespace Verthe\MailingListServiceProvider;

interface MailingListServiceProvider {

    /**
     * [subscribe used for handling user susbcription to mailing lists]
     *
     * @param  string $email user email address
     * @param  string $type  type of the mailing list
     */
    public function subscribe(string $email, string $type);

}
