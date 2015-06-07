<?php

return array(
    
    /*'user' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Пользователь',
        'bizRule' => null,
        'data' => null
    ),
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Администратор',
        'children' => array(
            'user',
        ),
        'bizRule' => null,
        'data' => null
    ),*/
    /*      ОПЕРАЦИИ        */
    'readCategory' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Просмотр категорий',
        'bizRule' => null,
        'data' => null
    ),
    'createCategory' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Создание категории',
        'bizRule' => null,
        'data' => null
    ),
    'updateCategory' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Изменение категории',
        'bizRule' => null,
        'data' => null
    ),
    'deleteCategory' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Удаление категории',
        'bizRule' => null,
        'data' => null
    ),
    
    'indexPost' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Просмотр записей',
        'bizRule' => null,
        'data' => null
    ),
    'viewPost' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Просмотр записи',
        'bizRule' => null,
        'data' => null
    ),
    'createPost' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Создание записи',
        'bizRule' => null,
        'data' => null
    ),
    'updatePost' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Изменение записи',
        'bizRule' => null,
        'data' => null
    ),
    'deletePost' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Удаление записи',
        'bizRule' => null,
        'data' => null
    ),
    
    'indexComment' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Просмотр комментариев',
        'bizRule' => null,
        'data' => null
    ),
    'viewComment' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Просмотр комментария',
        'bizRule' => null,
        'data' => null
    ),
    'updateComment' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Изменение комментария',
        'bizRule' => null,
        'data' => null
    ),
    'deleteComment' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Удаление комментария',
        'bizRule' => null,
        'data' => null
    ),
    
    'indexTag' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Просмотр тэгов',
        'bizRule' => null,
        'data' => null
    ),
    
    'indexUser' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Просмотр профилей пользователей',
        'bizRule' => null,
        'data' => null
    ),
    'viewUser' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Просмотр профиля пользователя',
        'bizRule' => null,
        'data' => null
    ),
    'updateUser' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Изменение профиля пользователя',
        'bizRule' => null,
        'data' => null
    ),
    'deleteUser' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Удаление профиля пользователя',
        'bizRule' => null,
        'data' => null
    ),
    
    'indexPage' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Просмотр страниц',
        'bizRule' => null,
        'data' => null
    ),
    'viewPage' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Просмотр страницы',
        'bizRule' => null,
        'data' => null
    ),
    'createPage' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Создание страницы',
        'bizRule' => null,
        'data' => null
    ),
    'updatePage' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Изменение страницы',
        'bizRule' => null,
        'data' => null
    ),
    'deletePage' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Удаление страницы',
        'bizRule' => null,
        'data' => null
    ),
    
    'indexConfig' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'description' => 'Просмотр и изменение общих настроек',
        'bizRule' => null,
        'data' => null
    ),
    
    /*      ЗАДАЧИ       */
    'viewOwnPost' => array(
        'type' => CAuthItem::TYPE_TASK,
        'description' => 'Изменение своей записи',
        'children' => array(
            'viewPost',
        ),
        'bizRule' => 'return Yii::app()->user->id==$params["post"]->author_id;',
        'data' => null
    ),
    'updateOwnPost' => array(
        'type' => CAuthItem::TYPE_TASK,
        'description' => 'Изменение своей записи',
        'children' => array(
            'updatePost',
        ),
        'bizRule' => 'return Yii::app()->user->id==$params["post"]->author_id;',
        'data' => null
    ),
    'deleteOwnPost' => array(
        'type' => CAuthItem::TYPE_TASK,
        'description' => 'Удаление своей записи',
        'children' => array(
            'deletePost',
        ),
        'bizRule' => 'return Yii::app()->user->id==$params["post"]->author_id;',
        'data' => null
    ),
    'viewOwnComment' => array(
        'type' => CAuthItem::TYPE_TASK,
        'description' => 'Просмотр своего комментария',
        'children' => array(
            'viewComment',
        ),
        'bizRule' => 'return Yii::app()->user->id==$params["comment"]->auth_author->id;',
        'data' => null
    ),
    'viewOwnPostComment' => array(
        'type' => CAuthItem::TYPE_TASK,
        'description' => 'Просмотр комментария к своей записи',
        'children' => array(
            'viewComment',
        ),
        'bizRule' => 'return Yii::app()->user->id==$params["comment"]->post->author_id;',
        'data' => null
    ),
    
    'viewOwnProfile' => array(
        'type' => CAuthItem::TYPE_TASK,
        'description' => 'Просмотр своего профиля',
        'children' => array(
            'viewUser',
        ),
        'bizRule' => 'return Yii::app()->user->id==$params["user"]->id;',
        'data' => null
    ),
    
    'updateOwnProfile' => array(
        'type' => CAuthItem::TYPE_TASK,
        'description' => 'Изменение своего профиля',
        'children' => array(
            'updateUser',
        ),
        'bizRule' => 'return Yii::app()->user->id==$params["user"]->id;',
        'data' => null
    ),
        
    /*      РОЛИ       */
    'subscriber' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Подписчик',
        'children' => array(
            'indexComment',
            'viewOwnComment',
            'viewOwnProfile',
            'updateOwnProfile',
        ),
        'bizRule' => null,
        'data' => null
    ),
    'author' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Автор',
        'children' => array(
            'subscriber',
            'indexPost',
            'createPost',
            'viewOwnPost', 
            'updateOwnPost',
            'deleteOwnPost',
            'viewOwnPostComment',
            'indexTag',
        ),
        'bizRule' => null,
        'data' => null
    ),
    'editor' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Редактор',
        'children' => array(
            'author',
            'readCategory',
            'createCategory',
            'updateCategory',
            'deleteCategory',
            'viewPost',
            'updatePost',
            'deletePost',
            'viewComment',
            'updateComment',
            'deleteComment',
            'indexPage',
            'viewPage',
            'createPage',
            'updatePage',
            'deletePage',
        ),
        'bizRule' => null,
        'data' => null
    ),
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Администратор',
        'children' => array(
            'editor',
            'indexUser',
            'viewUser',
            'updateUser',
            'deleteUser',
            'indexConfig',
        ),
        'bizRule' => null,
        'data' => null
    ),
);

