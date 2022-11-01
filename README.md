# workshop frontend backend
Getting Started to Frontend and Backend

## Schema

```
{
  name: string
  age: number
  address: string
  phone: string
}
```

## Create Database
```
CREATE DATABASE biodata;
```

## Create Table
```
-- biodata.students definition

CREATE TABLE `students` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `age` int NOT NULL DEFAULT '0',
  `address` text,
  `phone` char(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```