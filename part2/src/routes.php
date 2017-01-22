<?php
// Routes

$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

//listar los empleados
$app->any('/listar', function ($request, $response, $args) {
    $a = new Employees();
    $email = $request->getParam("email");
    return $this->renderer->render($response, 'listar.phtml', ['employees' => $a->listEmployees($email)]);
});

//mostrar detalles de empleado
$app->get('/detalles/{id}', function ($request, $response, $args) {
    $a = new Employees();
    $employee = $a->showEmployee($args['id']);
    if (!$employee) {
        return $response->withStatus(302)->withHeader('Location', HOST . '/listar');
    }
    return $this->renderer->render($response, 'detalles.phtml', ['employee' => $employee]);
});


//servicio para consultar json
$app->get("/usuario-por-sueldo/{min}/{max}", function ($request, $response, $args) {
    $a = new Employees();
    $employees = $a->EmployeesRangeSalary($args['min'], $args['max']);
    return $response->withHeader(
        'Content-Type',
        'application/json'
    )->withJson($employees);
});


//servicio para consultar en formato  xml
$app->get("/usuario-por-sueldo-xml/{min}/{max}", function ($request, $response, $args) {
    $a = new Employees();
    $employees = $a->EmployeesRangeSalaryXml($args['min'], $args['max']);
    return $response->withHeader(
            'Content-Type',
            'application/xml'
    )->write($employees->asXML());
});


