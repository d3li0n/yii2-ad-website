<?php
namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

/* @var $scenario \Codeception\Scenario */

class CreatePostCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage(['ad/create-post']);
    }

    public function checkContact(FunctionalTester $I)
    {
        $I->see('Create your post', 'h2');
    }

    public function checkCreatePostSubmitNoData(FunctionalTester $I)
    {
        $I->submitForm('#create-post-form', []);
        $I->see('Create your post', 'h2');
        $I->seeValidationError('Title cannot be blank');
        $I->seeValidationError('Price cannot be blank');
        $I->seeValidationError('Country cannot be blank');
    }

    public function checkCreatePostSubmitNotCorrectTitle(FunctionalTester $I)
    {
        $I->submitForm('#create-post-form', [
            'CreatePostForm[title]' => 'tes',
            'CreatePostForm[description]' => 'test',
            'CreatePostForm[country]' => 'U',
            'CreatePostForm[price]' => 'test',
        ]);
        $I->seeValidationError('Title at least 4 characters.');
        $I->dontSeeValidationError('Description at least 20 characters.');
        $I->dontSeeValidationError('Country at least 2 characters.');
        $I->dontSeeValidationError('Price must be indicated by numbers.');
    }
}
