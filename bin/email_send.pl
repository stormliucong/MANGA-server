#!/usr/bin/perl
use strict;
use Email::Sender::Transport::SMTP::TLS;
use Email::Sender::Simple qw(sendmail);
use Email::Simple;

 my $transport = Email::Sender::Transport::SMTP::TLS ->new({
        host => 'smtp.mandrillapp.com',
        port => 587,
        username => 'yanghui@usc.edu',
        password => 'uh2BLq9VFE6IRUpMf0uMBQ',
        });

my $content = `df -h`;

my $email = Email::Simple->create(
        header => [
        To      => '<yanghui@usc.edu>',
        From    => '"Hui Yang" <yanghui@usc.edu>',
        'Reply-to' => '<yanghui@usc.edu>',
        subject => "space in bioinform2",
        ],
        body => $content,
);

sendmail($email, { transport => $transport });