<?php

namespace App\Orchid\Screens;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;

class EmailSenderScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'subject' => date('F') . ' Monthly Report',
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Email Sender';
    }

    /**
     * The description is displayed on the user's screen under the heading
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Tool that sends ad-hoc email messages.';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Send Message')
            ->icon('paper-plane')
            ->method('sendMessage')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('subject')
                ->title('Subject')
                ->placeholder('Message subject line')
                ->required()
                ->help('Enter the subject line for your message'),

                Relation::make('users.')
                ->title('Recipients')
                ->help('Enter the users that you would like to send this message to.')
                ->multiple()
                ->required()
                ->placeholder('Email addresses')
                ->fromModel(User::class,'name', 'email'),

                Quill::make('content')
                ->title('Message')
                ->required()
                ->placeholder('Message body')
                ->help('Add the content for the message that you would like to send.'),
            ])

        ];
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'subject' => 'required|min:6|max:50',
            'content' => 'required|min:10',
            'users' => 'required',
        ]);

        Mail::raw($request->get('content'), function (Message $message) use ($request) {
            $message->from('example@example.com');
            $message->subject($request->get('subject'));
            foreach ($request->get('users') as $user) {
                $message->to($user);
            }
        });

        Alert::info('Your email message has been sent successfully!');
    }
}
