<?php

namespace App\Parser;

use App\Checker\GiftChecker;
use App\Checker\ReceiverChecker;
use App\Exception\ImportGiftStockFileInvalidColumnNameException;
use App\Factory\GiftFactory;
use App\Factory\ReceiverFactory;
use App\Reader\ReaderInterface;
use App\Repository\GiftRepositoryInterface;
use App\Repository\ReceiverRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class GiftStockParser
{
    const GIFT_UUID_FIELD = 'gift_uuid';
    const GIFT_CODE_FIELD = 'gift_code';
    const GIFT_DESCRIPTION_FIELD = 'gift_description';
    const GIFT_PRICE_FIELD = 'gift_price';
    const RECEIVER_UUID_FIELD = 'receiver_uuid';
    const RECEIVER_FIRST_NAME_FIELD = 'receiver_first_name';
    const RECEIVER_LAST_NAME_FIELD = 'receiver_last_name';
    const RECEIVER_COUNTRY_CODE_FIELD = 'receiver_country_code';

    const COLUMN_NAMES = [
        self::GIFT_UUID_FIELD,
        self::GIFT_CODE_FIELD,
        self::GIFT_DESCRIPTION_FIELD,
        self::GIFT_PRICE_FIELD,
        self::RECEIVER_UUID_FIELD,
        self::RECEIVER_FIRST_NAME_FIELD,
        self::RECEIVER_LAST_NAME_FIELD,
        self::RECEIVER_COUNTRY_CODE_FIELD,
    ];

    private ReaderInterface $reader;
    private EntityManagerInterface $entityManager;
    private GiftRepositoryInterface $giftRepository;
    private ReceiverRepositoryInterface $receiverRepository;
    private GiftChecker $giftChecker;
    private ReceiverChecker $receiverChecker;

    public function __construct(
        ReaderInterface $reader,
        EntityManagerInterface $entityManager,
        GiftRepositoryInterface $giftRepository,
        ReceiverRepositoryInterface $receiverRepository,
        GiftChecker $giftChecker,
        ReceiverChecker $receiverChecker
    ) {
        $this->reader = $reader;
        $this->entityManager = $entityManager;
        $this->giftRepository = $giftRepository;
        $this->receiverRepository = $receiverRepository;
        $this->giftChecker = $giftChecker;
        $this->receiverChecker = $receiverChecker;
    }

    public function parse(string $path)
    {
        $this->reader->load($path);
        $this->reader->useFirstRowAsHeader();

        if ($this->reader->getColumnNames() !== self::COLUMN_NAMES) {
            throw new ImportGiftStockFileInvalidColumnNameException(self::COLUMN_NAMES, $this->reader->getColumnNames());
        }

        $this->entityManager->beginTransaction();

        try {
            foreach ($this->reader as $key => $row) {
                $gift = $this->giftRepository->findOneByUuid($row[self::GIFT_UUID_FIELD]);
                if (null === $gift) {
                    $gift = GiftFactory::create(
                        $row[self::GIFT_UUID_FIELD],
                        $row[self::GIFT_CODE_FIELD],
                        $row[self::GIFT_DESCRIPTION_FIELD],
                        $row[self::GIFT_PRICE_FIELD]
                    );
                    $this->giftChecker->check($gift);
                    $this->giftRepository->persist($gift);
                }

                $receiver = $this->receiverRepository->findOneByUuid($row[self::RECEIVER_UUID_FIELD]);
                if (null === $receiver) {
                    $receiver = ReceiverFactory::create(
                        $row[self::RECEIVER_UUID_FIELD],
                        $row[self::RECEIVER_FIRST_NAME_FIELD],
                        $row[self::RECEIVER_LAST_NAME_FIELD],
                        $row[self::RECEIVER_COUNTRY_CODE_FIELD]
                    );
                    $this->receiverChecker->check($receiver);
                }

                $receiver->addGift($gift);
                $this->receiverRepository->persist($receiver);

                if ($key % 200) {
                    $this->entityManager->flush();
                }
            }

            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();

            throw $e;
        }
    }
}
