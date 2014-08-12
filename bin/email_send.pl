use strict;
use Email::Sender::Transport::SMTP::TLS;
use Email::Sender::Simple qw(sendmail);
use Email::Simple;

my $transport = Email::Sender::Transport::SMTP::TLS ->new({
        host => 'smtp.gmail.com',
        port => 587,
        username => 'younghumanFly@gmail.com',
        password => 'younghuman',
        });



my $email = Email::Simple->create(
        header => [
        To      => '<yanghui@usc.edu>',
        From    => '"Hui Yang" <yanghui@usc.edu>',
        'Reply-to' => '<yanghui@usc.edu>',
        subject => "This is a test email",
        ],
        body => 'This is a test email',
);

sendmail($email, { transport => $transport });