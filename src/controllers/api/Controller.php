<?php
namespace hexaua\yiisupport\controllers\api;

use yii\rest\ActiveController;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\rest\Serializer;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

class Controller extends ActiveController
{
    public $serializer = [
        'class'              => Serializer::class,
        'collectionEnvelope' => 'items',
    ];

    /**
     * String the scenario used for search a models.
     */
    const SCENARIO_SEARCH = 'search';

    /**
     * @var array List of actions available without authentication
     */
    protected $accessExceptions = [];

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];

        $behaviors['rateLimiter']['enableRateLimitHeaders'] = true;

        $behaviors['contentNegotiator'] = [
            'class'   => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
                'application/xml'  => Response::FORMAT_XML,
            ],
        ];

        $behaviors['access'] = [
            'class'        => AccessControl::className(),
            'ruleConfig'   => [
                'class' => AccessRule::className(),
            ],
            'except'       => ['options'],
            'rules'        => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
            'denyCallback' => function () {
                throw new ForbiddenHttpException('Access denied');
            },
        ];

        $behaviors['authenticator']['except'] = $this->accessExceptions;

        $behaviors['access']['except'] = $this->accessExceptions;

        return $behaviors;
    }
}
