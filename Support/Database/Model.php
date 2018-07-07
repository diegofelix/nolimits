<?php
namespace Support\Database;

use MongoDB\BSON\ObjectId;
use MongolidLaravel\MongolidModel;

abstract class Model extends MongolidModel
{
    /**
     * Overwrites the update method in order to be able to check for
     * the expectation in the localMock in order to call the update method
     * into the existing mock and avoid touching the database.
     *
     * @return bool
     */
    public function update()
    {
        if ($this->localMockHasExpectationsFor('update')) {
            return $this->getLocalMock()->update();
        }

        return parent::update();
    }

    /**
     * Overwrite embed to cast models to array.
     *
     * @param string $field field to where the $obj will be embedded
     * @param mixed  $obj   document or model instance
     */
    public function embed(string $field, &$obj)
    {
        $isInstance = $obj instanceof MongolidModel;
        $document = $isInstance ? $obj->toArray() : $obj;

        if (is_array($document) && !isset($document['_id'])) {
            $generatedId = new ObjectId();
            $document['_id'] = $generatedId;

            if ($isInstance) {
                $obj->_id = $generatedId;
            }
        }

        parent::embed($field, $document);
    }

    /**
     * Return the unique key of the model.
     * It is intended to be used with Laravel NotificationFake only.
     *
     * @return string
     */
    public function getKey()
    {
        return (string) $this->_id;
    }
}
