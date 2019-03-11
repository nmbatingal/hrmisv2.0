<?php

use Illuminate\Database\Seeder;

class MorssQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            [ 'question' => 'Do you clearly understand your organization\'s policies and goals?' ],
            [ 'question' => 'Has your superior ably translated your organization\'s objectives into meaningful assignments and goals for you?' ],
            [ 'question' => 'Do you find your job interesting and challenging?' ],
            [ 'question' => 'Do you get any satisfaction from your work?' ],
            [ 'question' => 'Do you think you are getting a fair remuneration package (salary, bonus, allowances, and other benefits) for your job?' ],
            [ 'question' => 'Are you sufficiently recognized by your superior for performing a good job?' ],
            [ 'question' => 'Are you given adequate training and coaching to help you develop your potential?' ],
            [ 'question' => 'Does your superior take time to discuss with you your performance, growth and development?' ],
            [ 'question' => 'Do you think the amount of trust, cooperation, understanding and warmth that exists both among staff and between staff and management is high?' ],
            [ 'question' => 'Do you think teamwork in your department is good?' ],
            [ 'question' => 'Do you think there are good career opportunities and good chance for advancement in your organization?' ],
            [ 'question' => 'Do you think you do not need to play politics to get ahead in your organization?' ],
            [ 'question' => 'Do you think the management implements your organization\'s policies fairly?' ],
            [ 'question' => 'Can you trust the management and believe in what they say?' ],
            [ 'question' => 'Is communication in your organization effective, both among staff and between management and staff?' ],
            [ 'question' => 'Do you think the feelings, ideas and suggestions of staff are communicated to the management?' ],
            [ 'question' => 'Are you willing to put in efforts beyond that normally expected in order to help your organization be successful?' ],
            [ 'question' => 'Do you want to continue to work for your organization in the next 5 years?' ],
        ];

        DB::connection('mysql4')->table('morss_questions')->insert($questions);
    }
}

