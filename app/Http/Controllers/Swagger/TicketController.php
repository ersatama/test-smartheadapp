<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/tickets",
 *     summary="Создать заявку",
 *     tags={"Tickets"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name","email","phone","subject","text"},
 *             @OA\Property(property="name", type="string", example="Иван Иванов"),
 *             @OA\Property(property="email", type="string", example="ivan@example.com"),
 *             @OA\Property(property="phone", type="string", example="+77001234567"),
 *             @OA\Property(property="subject", type="string", example="Проблема с оплатой"),
 *             @OA\Property(property="text", type="string", example="У меня не прошла транзакция.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Успешно создано"
 *     ),
 *     @OA\Response(response=422, description="Ошибка валидации")
 * ),
 * @OA\Get(
 *     path="/api/tickets/statistics",
 *     summary="Получить статистику заявок",
 *     tags={"Tickets"},
 *     @OA\Response(
 *         response=200,
 *         description="Статистика по заявкам",
 *         @OA\JsonContent(
 *             @OA\Property(property="today", type="integer", example=5),
 *             @OA\Property(property="week", type="integer", example=30),
 *             @OA\Property(property="month", type="integer", example=100)
 *         )
 *     )
 * )
 */
class TicketController extends Controller
{

}
