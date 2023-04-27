CREATE TABLE Transmission (
    id serial PRIMARY KEY,
    type varchar(100) NOT NULL
)


INSERT INTO Brand VALUES (1, 'Rolls Royce')

INSERT INTO Model VALUES (1, 'Spectre', 1)

INSERT INTO color VALUES (1, 'Black')

ALTER TABLE image ALTER COLUMN data TYPE VARCHAR(200);

INSERT INTO useradmin VALUES (1, 'Asatullayev Abduraxmon', 'abduraxmon', 20)

INSERT INTO car VALUES (1, 1, 'One of the Best Car in the World', 60000, 1, 1, 1, 350, false, true, 12.0, 2023, 1)

INSERT INTO image VALUES (1, 'Spectre', 'JPG', 'C:\Users\Student\Downloads\Spectre.jpg', 1)

SELECT model.name AS model_name, description, price, color, transmission, body.name AS body_name, max_speed, is_sold, is_public, engine, year FROM car LEFT JOIN model ON car.id = model.id LEFT JOIN body ON car.id=body.id


select * from model