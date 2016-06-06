<?php
namespace Model;

/**
 * Class PageRepository
 * @package Model
 */
/**
 * Class PageRepository
 * @package Model
 */
class PageRepository
{

    /**
     * @var \PDO
     */
    private $PDO;

    /**
     * PageRepository constructor.
     * @param \PDO $PDO
     */
    public function __construct(\PDO $PDO)
    {
        $this->PDO = $PDO;
    }

    /**
     * @param int $id
     */
    public function getSlug($slug)
    {
        $sql = "
        SELECT
          `title`,
          `h1`,
          `body`,
          `span_class`,
          `span_text`,
          `img`
        FROM
          `page`
        WHERE
          `slug` = :slug
        ";
        $stmt = $this->PDO->prepare($sql);
        $stmt->bindParam(':slug', $slug);
        $stmt->execute();
        return $stmt->fetchObject();
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $sql = "
        SELECT
          `id`,
          `slug`,
          `title`,
          `h1`
        FROM
          `page`
        ";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }


    /**
     * @return array
     */
    public function findOne($id)
    {
        $sql = "
        SELECT
          `id`,
          `slug`,
          `title`,
          `h1`,
          `body`,
          `img`,
          `span_class`,
          `span_text`
        FROM
          `page`
        WHERE
          `id` = :id
        ";
        $stmt = $this->PDO->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject();
    }

//fetch permet de prendre le dernier résultat qui n'a pas été traiter
// fetch all va prendre toutes les données du tableau

    /**
     * @param $data
     * @return string
     */
    public function ajout($data)
    {
        $sql = "
        INSERT INTO
        `page`
        (`slug`,
        `h1`,
        `body`,
        `title`,
        `img`,
        `span_class`,
        `span_text`)
        VALUES
        (:slug,
        :h1,
        :body,
        :title,
        :img,
        :span_class,
        :span_text)
        ";
        $stmt = $this->PDO->prepare($sql);
        $stmt->bindParam(':slug', $data['page_slug'], \PDO::PARAM_STR);
        $stmt->bindParam(':h1', $data['page_h1'], \PDO::PARAM_STR);
        $stmt->bindParam(':body', $data['page_body'], \PDO::PARAM_STR);
        $stmt->bindParam(':title', $data['page_title'], \PDO::PARAM_STR);
        $stmt->bindParam(':img', $data['page_img'], \PDO::PARAM_STR);
        $stmt->bindParam(':span_class', $data['span_class'], \PDO::PARAM_STR);
        $stmt->bindParam(':span_text', $data['span_text'], \PDO::PARAM_STR);
        $stmt->execute();
        // retourne le dernier element selon son id
        return $this->PDO->lastInsertId();
    }


    /**
     * @param $data
     */
    public function modifier($data)
    {
        $sql = "
        UPDATE
        `page`
        SET
        `slug`=:slug,
        `h1`=:h1,
        `body`=:body,
        `title`=:title,
        `img`=:img,
        `span_class`=:span_class,
        `span_text`=:span_text
        WHERE
          `id`= :id
        ";
        $stmt = $this->PDO->prepare($sql);
        $stmt->bindValue(':slug', $data['page_slug'], \PDO::PARAM_STR);
        $stmt->bindValue(':h1', $data['page_h1'], \PDO::PARAM_STR);
        $stmt->bindValue(':body', $data['page_body'], \PDO::PARAM_STR);
        $stmt->bindValue(':title', $data['page_title'], \PDO::PARAM_STR);
        $stmt->bindValue(':img', $data['page_img'], \PDO::PARAM_STR);
        $stmt->bindValue(':span_class', $data['span_class'], \PDO::PARAM_STR);
        $stmt->bindValue(':span_text', $data['span_text'], \PDO::PARAM_STR);
        $stmt->bindValue(':id', $data['page_id'], \PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @param $id
     */
    public function supprimer($id)
    {
        $sql = "
        DELETE FROM
          `page`
        WHERE
          `id`= :id
        ";
        $stmt = $this->PDO->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

}