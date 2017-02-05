<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 05.02.17
 * Time: 17:02
 */

namespace app\repositories;

use yii\base\Model;

interface QuestionRepositoryInterface
{
    public function find($id);

    public function add(Model $question);

    public function save(Model $employee);
}