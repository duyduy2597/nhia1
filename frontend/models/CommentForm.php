<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use backend\models\Product;
/**
 * ContactForm is the model behind the contact form.
 */
class CommentForm extends Model
{
    public $email;
    public $body;
    //public $verifyCode;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [[ 'email', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            ['body', 'string', 'min' => 10, 'max' => 255],
            // verifyCode needs to be entered correctly
            //['verifyCode', 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
            'body' => 'Nhập nội dung'
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
        ->setTo($email)
        ->setFrom([$this->email => $this->name])
        ->setSubject($this->subject)
        ->setTextBody($this->body)
        ->send();
    }

    public function validateByEmail()
    {
        $user = User::findOne(['email' => $this->email]);
        if ($user) {
            return $user->getAttributes();
        }else{
            $this->addError('email', 'Email của bạn không tồn tại trong hệ thống, vui lòng kiểm tra lại !');
            $this->email = '';
            return false;
        }        
    }

    public function createComment($user,$productId)
    {
        $product = Product::findOne($productId);
        $comments = json_decode($product->comment,true);
        if (is_null($comments)) {
            $comments = [];
        }
        $creation_time = time();
        $userComment = [
            'id' => $user['id'],
            'name' => $user['username'],
            'email' => $user['email'],
        ];
        $contentComment = [
            'user' => $userComment,
            'content' => $this->body,
            'creation_time' => $creation_time
        ];
        $comments[$creation_time] = $contentComment;
        $product->comment = json_encode($comments);
        if ($product->save()) {
            return $comments;
        }else{
            return false;
        }
    }

}
